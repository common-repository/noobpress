<?php
namespace NoobPress\Security\Login;

use NoobPress\Dependencies\LaunchpadCore\Container\PrefixAware;
use NoobPress\Dependencies\LaunchpadCore\Container\PrefixAwareInterface;
use NoobPress\Dependencies\LaunchpadCore\Dispatcher\DispatcherAwareInterface;
use NoobPress\Dependencies\LaunchpadCore\Dispatcher\DispatcherAwareTrait;
use NoobPress\Dependencies\LaunchpadOptions\Interfaces\TransientsInterface;

class LimitLoginSubscriber implements DispatcherAwareInterface, PrefixAwareInterface
{
    use DispatcherAwareTrait, PrefixAware;

    /**
     * @var State
     */
    protected $state;

    /**
     * @var TransientsInterface
     */
    protected $transients;

    /**
     * @param State $state
     */
    public function __construct(State $state, TransientsInterface $transients)
    {
        $this->state = $state;
        $this->transients = $transients;
    }

    /**
     * @hook wp_authenticate
     */
    public function feed_state_empty_login($user, $password)
    {
        $this->state->set_empty_credentials(empty($user) && empty($password));
    }

    /**
     * @hook $prefixis_empty_credentials
     */
    public function share_state_empty_credentials($empty) {
        return $this->state->is_empty_credentials();
    }

    /**
     * @hook wp_login_failed
     */
    public function increase_counter_failures()
    {
        $ip = $this->dispatcher->apply_string_filters("{$this->prefix}ip_address", '');
        $max = $this->dispatcher->apply_int_filters("{$this->prefix}counter_max", 5);
        $expiration = $this->dispatcher->apply_int_filters("{$this->prefix}counter_expiration", 5 * MINUTE_IN_SECONDS);
        $empty = $this->dispatcher->apply_bool_filters("{$this->prefix}is_empty_credentials", false);

        if( $empty ) {
            return;
        }

        $counter = (int) $this->transients->get("counter_{$ip}");
        $this->transients->set("counter_{$ip}", ++ $counter, $expiration);

        if($counter < $max) {
            return;
        }

        $this->transients->set("locked_{$ip}", true, $expiration);
    }

    /**
     * @hook $prefixip_address
     */
    public function fetch_correct_ip_address($ip, $client_type = '')
    {
        if( ! $client_type || ! key_exists($client_type, $_SERVER) ) {
            $client_type = $this->dispatcher->apply_string_filters("{$this->prefix}ip_address_client_type", 'REMOTE_ADDR');
        }

        if( ! key_exists($client_type, $_SERVER)) {
            return $ip;
        }

        return $_SERVER[$client_type];
    }

    /**
     * @hook wp_authenticate_user
     */
    public function maybe_refuse_attempt($user)
    {

        $ip = $this->dispatcher->apply_string_filters("{$this->prefix}ip_address", '');

        if( ! $this->transients->get("locked_{$ip}")) {
            return $user;
        }

        $error = new \WP_Error();
        $error->add('too_many_retries', __('<strong>ERROR</strong>: Too many failed login attempts.', 'noobpress'));
        return $error;
    }

    /**
     * @hook shake_error_codes
     */
    public function add_error_code($errors)
    {
        if(! is_array($errors)){
            return $errors;
        }

        $errors []= 'too_many_retries';
        return $errors;
    }

    /**
     * @hook login_errors
     */
    public function fix_error_messages($errors)
    {
        $ip = $this->dispatcher->apply_string_filters("{$this->prefix}ip_address", '');

        if(! $this->transients->get("locked_{$ip}")) {
            return $errors;
        }

        return '<p>' . __('<strong>ERROR</strong>: Too many failed login attempts.', 'noobpress') . '</p>';
    }

    /**
     * @hook wp_login
     */
    public function reset_counter()
    {
        $ip = $this->dispatcher->apply_string_filters("{$this->prefix}ip_address", '');

        $this->transients->delete("locked_{$ip}");
    }
}