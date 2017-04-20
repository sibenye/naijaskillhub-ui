<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * User Id.
     *
     * @var int
     */
    private $id;

    /**
     * Is user active.
     *
     * @var bool
     */
    private $isActive;

    /**
     *
     * @var string
     */
    private $email;

    /**
     *
     * @var string
     */
    private $vanityName;

    /**
     * List of user's credential types.
     *
     * @var array
     */
    private $credentialTypes;

    /**
     * List of user's account types.
     *
     * @var array
     */
    private $accountTypes;

    /**
     * User's portfolio summary.
     *
     * @var array
     */
    private $portfolio;

    /**
     * List of user's portfolio categories.
     *
     * @var array
     */
    private $categories;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [ ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            'password',
            'remember_token'
    ];

    public function getIdAttribute()
    {
        return $this->id;
    }

    public function setIdAttribute($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getIsActiveAttribute()
    {
        return $this->isActive;
    }

    public function setIsActiveAttribute($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function getEmailAttribute()
    {
        return $this->email;
    }

    public function setEmailAttribute($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getVanityNameAttribute()
    {
        return $this->vanityName;
    }

    public function setVanityNameAttribute($vanityName)
    {
        $this->vanityName = $vanityName;
        return $this;
    }

    public function getCredentialTypesAttribute()
    {
        return $this->credentialTypes;
    }

    public function setCredentialTypesAttribute(array $credentialTypes)
    {
        $this->credentialTypes = $credentialTypes;
        return $this;
    }

    public function getAccountTypesAttribute()
    {
        return $this->accountTypes;
    }

    public function setAccountTypesAttribute(array $accountTypes)
    {
        $this->accountTypes = $accountTypes;
        return $this;
    }

    public function getPortfolioAttribute()
    {
        return $this->portfolio;
    }

    public function setPortfolioAttribute(array $portfolio)
    {
        $this->portfolio = $portfolio;
        return $this;
    }

    public function getCategoriesAttribute()
    {
        return $this->categories;
    }

    public function setCategoriesAttribute(array $categories)
    {
        $this->categories = $categories;
        return $this;
    }
}
