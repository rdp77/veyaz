<?php
namespace App\Entities;

use LaravelCommon\App\Entities\BaseEntity;

class MyScope extends BaseEntity
{
	protected ?string $role = null;
	protected ?string $description = null;

	/**
	 * Set role 
	 *
	 * @param string role
	 * @return self
	 */
	public function setRole(string $role): MyScope
	{
		$this->role = $role;
		return $this;
	}

	/**
	 * Get role 
	 *
	 * @return string
	 */
	public function getRole(): string 
	{
		return $this->role;
 	}

	/**
	 * Set description 
	 *
	 * @param string description
	 * @return self
	 */
	public function setDescription(string $description): MyScope
	{
		$this->description = $description;
		return $this;
	}

	/**
	 * Get description 
	 *
	 * @return string
	 */
	public function getDescription(): string 
	{
		return $this->description;
 	}


}
        