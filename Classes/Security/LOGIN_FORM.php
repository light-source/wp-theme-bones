<?php

declare( strict_types=1 );

namespace WpThemeBones\Classes\Security;

defined( 'ABSPATH' ) ||
die( 'Constant is missing' );

use LightSource\DataTypes\DATA_TYPES;
use LightSource\StdResponse\STD_RESPONSE;
use WP_Error;
use WP_User;
use WpThemeBones\Classes\{
	Acf\SITE_SETTINGS,
	HELPER};

abstract class LOGIN_FORM {

	//////// constants

	const G_CAPTCHA_FIELD_NAME = 'g-recaptcha-response'; //  google defines, can't be changed
	const G_CAPTCHA_API_URL = 'https://www.google.com/recaptcha/api/siteverify';

	//////// static methods

	final private static function _CaptchaVerify( string $token ): bool {

		$captchaPrivateKey = SITE_SETTINGS::Get( SITE_SETTINGS::GOOGLE_CAPTCHA__PRIVATE_KEY, 'options' );

		$isVerified = false;

		$apiArgs   = [
			'secret'   => $captchaPrivateKey,
			'response' => $token,
		];
		$apiString = HELPER::CUrl( self::G_CAPTCHA_API_URL, true, $apiArgs );

		if ( $apiString ) {

			$apiJson       = json_decode( $apiString, true );
			$jsonLastError = json_last_error();

			if ( is_null( $apiJson ) ||
			     JSON_ERROR_NONE !== $jsonLastError ) {
				return $isVerified;
			}

			if ( is_array( $apiJson ) &&
			     key_exists( 'success', $apiJson ) &&
			     key_exists( 'hostname', $apiJson ) &&
			     true === $apiJson['success'] &&
			     $apiJson['hostname'] === HELPER::GetCurrentHost()
			) {
				$isVerified = true;
			}
		}

		return $isVerified;
	}

	final public static function OnResources(): void {

		//$logo             = Theme::GetImageUrl( 'logo.svg' );
		$captchaPublicKey = SITE_SETTINGS::Get( SITE_SETTINGS::GOOGLE_CAPTCHA__PUBLIC_KEY, 'options' );
		//$favicon          = Theme::GetImageUrl( 'favicon.ico' );

		?>
        <!--<link rel="Shortcut Icon" type="image/x-icon" href="<?/*= $favicon; */ ?>"/>-->
        <style type="text/css">
            /*#login h1 a, .login h1 a {
                background-image: url(

            <? //echo $logo; ?>

						);
										width: 120px;
										height: 120px;
										background-size: cover;
									}*/

            #login {
                width: 350px !important;
            }

            .g-captcha {
                margin: 0 0 20px !important;
            }
        </style>
		<?php if ( $captchaPublicKey ) { ?>
            <script src="https://www.google.com/recaptcha/api.js?onload=gCaptchaOnLoad&render=explicit" async
                    defer></script>
            <script type="text/javascript">
                window.gCaptchaOnLoad = () => {

                    let elements = document.getElementsByClassName('g-captcha');

                    if ('undefined' === typeof grecaptcha ||
                        0 === elements.length) {
                        return;
                    }

                    grecaptcha.render(elements[0], {
                        'sitekey': '<?= $captchaPublicKey; ?>',
                        // 'size': 'compact',
                    });

                };
            </script>

			<?php
		}
	}

	final public static function OnFields(): void {

		$captchaPublicKey = SITE_SETTINGS::Get( SITE_SETTINGS::GOOGLE_CAPTCHA__PUBLIC_KEY, 'options' );

		if ( $captchaPublicKey ) {
			echo '<div class="g-captcha"></div>';
		}

	}

	/**
	 * @param WP_User|WP_Error $user
	 * @param string $password
	 *
	 * @return WP_User|WP_Error
	 */
	final public static function FilterVerify( $wpUser, string $password ) {

		$response = $wpUser;

		$captchaPublicKey = SITE_SETTINGS::Get( SITE_SETTINGS::GOOGLE_CAPTCHA__PUBLIC_KEY, 'options' );

		if ( ! $captchaPublicKey ) {
			return $response;
		}

		$token         = $_POST[ self::G_CAPTCHA_FIELD_NAME ] ?? '';
		$tokenResponse = DATA_TYPES::Clear( DATA_TYPES::STRING, $token );

		if ( ! $tokenResponse[ STD_RESPONSE::IS_SUCCESS ] ) {
			return new WP_Error( 'security_fail', 'Security field is missing' );
		}

		$token = $tokenResponse[ STD_RESPONSE::ARGS ] [ DATA_TYPES::_ARG__VALUE ];

		if ( ! self::_CaptchaVerify( $token ) ) {
			return new WP_Error( 'security_fail', 'Security field is wrong' );
		}

		return $response;
	}

}
