<?php
$_passedProps = array();

/**
 * Get a component as a string.
 * @param string $_component_name The name of the component.
 * @param array $_props The props to pass to the component.
 * @return string The component
 */
function Component(string $_component_name, ...$_props): string
{
    global $_passedProps;
    $_passedProps = $_props;
    ob_start();
    include COMPONENTS_DIR . $_component_name . '.php';
    return ob_get_clean();
}

/**
 * Get a prop from its key.
 * @param string $_key The key of the prop.
 * @param mixed $_default The default value if prop is unset.
 * @return mixed The value of the prop, or a default value if prop is unset.
 */
function Prop(string $_key, mixed $_default = ''): mixed
{
    global $_passedProps;
    $_prop = isset($_passedProps[$_key]) ? $_passedProps[$_key] : $_default;
    return $_prop;
}
