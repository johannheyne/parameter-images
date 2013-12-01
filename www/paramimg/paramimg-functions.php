<?php

    // Parameter-Images Functions

    function paramimg_get_image( $p = array() ) {

        /* README {

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
                'param_array' => array(),
                'param_string' => '',
            );

            $return = false;

        // }

        // FUNCTIONALITY {

            if ( $p['param'] ) {

                $vars['param_array'][] = 'param=' . paramimg_encode_query( array( 'setup' => $p['param'] ) );
            }

            if ( $p['id'] ) {

                $vars['param_array'][] = 'id=' . $p['id'];
            }

            if ( $p['src'] ) {

                if ( $vars['param_array'] ) {

                    $vars['param_string'] = '?' . implode( '&', $vars['param_array'] );
                }

                $return .= '<img src="' . $p['src'] . $vars['param_string'] . '">';
            }

        // }

        return $return;
    }

    function paramimg_encode_query( $p = array() ) {

        /* README {

        } */

        // DEFAULTS {

            $defaults = array(
                'setup' => array(),
                'compress' => true,
            );

            $p = array_replace_recursive( $defaults, $p );

        // }

        // FUNCTION VARIABLES {

            $return = false;

        // }

        // FUNCTIONALITY {

            if ( $p['setup'] ) {

                $return = http_build_query( $p['setup'] );

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