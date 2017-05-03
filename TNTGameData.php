<?php

class TNTGameData
{
	const WPN_NAME_PREFIX = 'weapon_';

	private $game_data;

	public function __construct( $game_data_json ) {
		$this->game_data = json_decode( $game_data_json, true );
	}

	public function getUnitAttr( $uname, $attr ) {
		$unit = $this->game_data['units'][$uname];
		if ( $unit === null ) {
			return null;
		}

		return $unit[$attr];
	}

	public function getUnitWeaponAttr( $uname, $attr ) {
		$wpn = $this->getUnitWeapon( $uname );
		if ( $wpn === null ) {
			return null;
		}

		return $wpn[$attr];
	}

	public function getTraitAttr( $tname, $attr ) {

		$trait = $this->game_data['filters']['traits'][$tname];
		if ( $trait === null ) {
			return null;
		}

		return $trait[$attr];
	}

	public function getWeaponAttr( $wname, $attr ) {

		$wpn = $this->game_data['weapons'][$wname];
		if ( $wpn === null ) {
			return null;
		}

		return $wpn[$attr];
	}

	/**
	 * @param $uname string unit name
	 * @return array first weapon that unit has or NULL if no weapons found
	 */
	public function getUnitWeapon( $uname ) {
		$unit = $this->game_data['units'][$uname];
		if ( $unit === null ) {
			return null;
		}

		$traits = $unit['traits'];
		if ( $traits === null ) {
			return null;
		}

		foreach ( $traits as $trait_name ) {
			$wpn_name = $this->game_data['filters']['traits'][$trait_name]['wpn'];
			if ( $wpn_name != null ) {
				return $this->game_data['weapons'][substr( $wpn_name, strlen( TNTGameData::WPN_NAME_PREFIX ) )];
			}
		}

		return null;
	}

}
