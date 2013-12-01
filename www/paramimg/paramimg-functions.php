<?php

    // Parameter-Images Functions

    function paramimg_get_image( $p = array() ) {

        /* README {

            Returns the image tag based on the given parameters.

        } */

        // DEFAULTS {

            $defaults = array(
                'id' => '',
                'param' => '',
                'src' => '',
            );

            $p = array_replace_recursive( $defaults, $p );

        // }

        // FUNCTION VARIABLES {

            $vars = array(

                /* 'param_array'

                    Collects all image src parameter key-value pairs like 'id=something'.
                    This array is assembled in the variable 'param_string' as a complete 
                    parameterstring like '?id=something' just before building the image tag.
                */

                'param_array' => array(),

                /* 'param_string'

                    Holds the complete parameterstring like '?id=something' and is generated
                    from the variable 'param_array' just before building the image tag.
                */

                'param_string' => '',
            );

            $return = false;

        // }

        // FUNCTIONALITY {

            // GET THE IMAGE PARAMETER ARRAY {

                if ( $p['param'] ) {

                    $vars['param_array'][] = 'param=' . paramimg_encode_query( array( 'parameters' => $p['param'] ) );
                }

            // }

            // GET THE IMAGE PARAMETER ID {

                if ( $p['id'] ) {

                    $vars['param_array'][] = 'id=' . $p['id'];
                }

            // }

            // BUILD THE IMAGE TAG {

                if ( $p['src'] ) {

                    if ( $vars['param_array'] ) {

                        $vars['param_string'] = '?' . implode( '&', $vars['param_array'] );
                    }

                    $return .= '<img src="' . $p['src'] . $vars['param_string'] . '">';
                }

            // }

        // }

        return $return;
    }

    function paramimg_encode_query( $p = array() ) {

        /* README {

            Takes an array and builds an query string
            and optional compresses the query string.

        } */

        // DEFAULTS {

            $defaults = array(
                'parameters' => array(),
                'compress' => true,
            );

            $p = array_replace_recursive( $defaults, $p );

        // }

        // FUNCTION VARIABLES {

            $return = false;

        // }

        // FUNCTIONALITY {

            if ( $p['parameters'] ) {

                $return = http_build_query( $p['parameters'] );

                if ( $p['compress'] ) {

                   $return = gzcompress( $return, 9 );
                   $return = rawurlencode( $return );
                }
            }

        // }

        return $return;
    }

    function paramimg_decode_query( $p = array() ) {

        /* README {

        } */

        // DEFAULTS {

            $defaults = array(
                'query' => false,
                'uncompress' => true
            );

            $p = array_replace_recursive( $defaults, $p );

        // }

        // FUNCTION VARIABLES {

            $return = false;

        // }

        // FUNCTIONALITY {

            if ( $p['query'] ) {

                if ( $p['uncompress'] ) {

                    $p['query'] = rawurldecode( $p['query'] );
                    $p['query'] = gzuncompress( $p['query'] );
                }

                parse_str( $p['query'], $return );
            }

        // }

        return $return;
    }

?>