<?php
/**
 * Hooks for AccessTNTGameData extension
 *
 * @file
 * @ingroup Extensions
 */

class AccessTNTGameDataHooks {

	public static function onParserFirstCallInit( Parser &$parser ) {
		global $wgATNTGDGameDataFilename;
		$game_data_json = file_get_contents( $wgATNTGDGameDataFilename );
		$tnt_data = new TNTGameData( $game_data_json );

		$parser->setFunctionHook( 'tnt_unit_attr', function ( $parser, ...$args ) use ( $tnt_data ) {
			return self::convertOutput( [ $tnt_data, 'getUnitAttr' ], $args );
		} );
		$parser->setFunctionHook( 'tnt_trait_attr', function ( $parser, ...$args ) use ( $tnt_data ) {
			return self::convertOutput( [ $tnt_data, 'getTraitAttr' ], $args );
		} );
		$parser->setFunctionHook( 'tnt_wpn_attr', function ( $parser, ...$args ) use ( $tnt_data ) {
			return self::convertOutput( [ $tnt_data, 'getWeaponAttr' ], $args );
		} );
		$parser->setFunctionHook( 'tnt_unit_wpn_attr', function ( $parser, ...$args ) use ( $tnt_data ) {
			return self::convertOutput( [ $tnt_data, 'getUnitWeaponAttr' ], $args );
		} );
	}

	public static function convertOutput( $callable, $args ) {
		$res = call_user_func_array( $callable, $args );

		if ( $res === null ) {
			return "-";
		}

		if ( is_array( $res ) ) {
			return implode( ',', $res );
		}

		return $res;
	}
}
