<?php
namespace App\Entities;

use DateTime;
use Illuminate\Support\Facades\Hash;
use LaravelCommon\App\Entities\BaseEntity;

class MyUser extends BaseEntity
{
	protected ?string $name = null;
	protected ?string $username = null;
	protected ?string $email = null;
	protected ?DateTime $emailVerifiedAt = null;
	protected ?string $password = null;
	protected ?string $twoFactorSecret = null;
	protected ?string $twoFactorRecoveryCodes = null;
	protected ?DateTime $twoFactorConfirmedAt = null;
	protected ?string $rememberToken = null;
	protected ?int $currentTeamId = null;
	protected ?string $profilePhotoPath = null;
	protected ?MyScope $scope = null;
	protected ?bool $isDeleted = false;

	/**
	 * Set name 
	 *
	 * @param string name
	 * @return self
	 */
	public function setName(string $name): MyUser
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * Get name 
	 *
	 * @return string
	 */
	public function getName(): string 
	{
		return $this->name;
 	}

	/**
	 * Set username 
	 *
	 * @param string username
	 * @return self
	 */
	public function setUsername(string $username): MyUser
	{
		$this->username = $username;
		return $this;
	}

	/**
	 * Get username 
	 *
	 * @return string
	 */
	public function getUsername(): string 
	{
		return $this->username;
 	}

	/**
	 * Set email 
	 *
	 * @param string email
	 * @return self
	 */
	public function setEmail(string $email): MyUser
	{
		$this->email = $email;
		return $this;
	}

	/**
	 * Get email 
	 *
	 * @return string
	 */
	public function getEmail(): string 
	{
		return $this->email;
 	}

	/**
	 * Set emailVerifiedAt 
	 *
	 * @param ?DateTime emailVerifiedAt
	 * @return self
	 */
	public function setEmailVerifiedAt(?DateTime $emailVerifiedAt): MyUser
	{
		$this->emailVerifiedAt = $emailVerifiedAt;
		return $this;
	}

	/**
	 * Get emailVerifiedAt 
	 *
	 * @return ?DateTime
	 */
	public function getEmailVerifiedAt(): ?DateTime 
	{
		return $this->emailVerifiedAt;
 	}

	/**
	 * Set password 
	 *
	 * @param string password
	 * @return self
	 */
	public function setPassword(string $password): MyUser
	{
		$this->password = $password;
		return $this;
	}

	/**
	 * Get password 
	 *
	 * @return string
	 */
	public function getPassword(): string 
	{
		return $this->password;
 	}

	/**
	 * Set twoFactorSecret 
	 *
	 * @param ? twoFactorSecret
	 * @return self
	 */
	public function setTwoFactorSecret(?string $twoFactorSecret): MyUser
	{
		$this->twoFactorSecret = $twoFactorSecret;
		return $this;
	}

	/**
	 * Get twoFactorSecret 
	 *
	 * @return ?
	 */
	public function getTwoFactorSecret(): ?string 
	{
		return $this->twoFactorSecret;
 	}

	/**
	 * Set twoFactorRecoveryCodes 
	 *
	 * @param ? twoFactorRecoveryCodes
	 * @return self
	 */
	public function setTwoFactorRecoveryCodes(?string $twoFactorRecoveryCodes): MyUser
	{
		$this->twoFactorRecoveryCodes = $twoFactorRecoveryCodes;
		return $this;
	}

	/**
	 * Get twoFactorRecoveryCodes 
	 *
	 * @return ?
	 */
	public function getTwoFactorRecoveryCodes(): ?string 
	{
		return $this->twoFactorRecoveryCodes;
 	}

	/**
	 * Set twoFactorConfirmedAt 
	 *
	 * @param ?DateTime twoFactorConfirmedAt
	 * @return self
	 */
	public function setTwoFactorConfirmedAt(?DateTime $twoFactorConfirmedAt): MyUser
	{
		$this->twoFactorConfirmedAt = $twoFactorConfirmedAt;
		return $this;
	}

	/**
	 * Get twoFactorConfirmedAt 
	 *
	 * @return ?DateTime
	 */
	public function getTwoFactorConfirmedAt(): ?DateTime 
	{
		return $this->twoFactorConfirmedAt;
 	}

	/**
	 * Set rememberToken 
	 *
	 * @param ?string rememberToken
	 * @return self
	 */
	public function setRememberToken(?string $rememberToken): MyUser
	{
		$this->rememberToken = $rememberToken;
		return $this;
	}

	/**
	 * Get rememberToken 
	 *
	 * @return ?string
	 */
	public function getRememberToken(): ?string 
	{
		return $this->rememberToken;
 	}

	/**
	 * Set currentTeamId 
	 *
	 * @param ?int currentTeamId
	 * @return self
	 */
	public function setCurrentTeamId(?int $currentTeamId): MyUser
	{
		$this->currentTeamId = $currentTeamId;
		return $this;
	}

	/**
	 * Get currentTeamId 
	 *
	 * @return ?int
	 */
	public function getCurrentTeamId(): ?int 
	{
		return $this->currentTeamId;
 	}

	/**
	 * Set profilePhotoPath 
	 *
	 * @param ?string profilePhotoPath
	 * @return self
	 */
	public function setProfilePhotoPath(?string $profilePhotoPath): MyUser
	{
		$this->profilePhotoPath = $profilePhotoPath;
		return $this;
	}

	/**
	 * Get profilePhotoPath 
	 *
	 * @return ?string
	 */
	public function getProfilePhotoPath(): ?string 
	{
		return $this->profilePhotoPath;
 	}

	/**
	 * Set scope
	 *
	 * @param int scope
	 * @return self
	 */
	protected function setScope(MyScope $scope): MyUser
	{
		$this->scope = $scope;
		return $this;
	}

	/**
	 * Get scope
	 *
	 * @return Scope
	 */
	protected function getScope(): ?MyScope 
	{
		return $this->scope;
 	}



	/**
	 * Get the value of isDeleted
	 */ 
	public function getIsDeleted(): bool
	{
		return $this->isDeleted;
	}

	/**
	 * Set the value of isDeleted
	 *
	 * @return  self
	 */ 
	public function setIsDeleted(bool $isDeleted)
	{
		$this->isDeleted = $isDeleted;

		return $this;
	}
}
        