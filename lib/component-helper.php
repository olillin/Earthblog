<?php
$passedProps = array();

/**
 * Get a component as a string.
 * @param string $name The name of the component.
 * @param array $props The props to pass to the component.
 * @return string The component
 */
function Component(string $name, ...$props): string
{
    global $passedProps;
    $passedProps = $props;
    ob_start();
    include COMPONENTS_DIR . $name . '.php';
    return ob_get_clean();
}

/**
 * Get a prop from its key.
 * @param string $key The key of the prop.
 * @param mixed $default The default value if prop is unset.
 * @return mixed The value of the prop, or a default value if prop is unset.
 */
function Prop(string $key, mixed $default = ''): mixed
{
    global $passedProps;
    $prop = isset($passedProps[$key]) ? $passedProps[$key] : $default;
    return $prop;
}
