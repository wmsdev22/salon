<?php
/*
 * File name: Membership.php
 * Last modified: 2022.03.08 at 14:33:13
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2022
 */

namespace App\Models;

use App\Traits\HasTranslations;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * Class Membership
 * @package App\Models
 * @version January 19, 2021, 2:04 pm UTC
 * @property EService[] featuredEServices
 * @property EService[] eServices
 * @property string name
 * @property string color
 * @property string description
 * @property integer order
 * @property boolean featured
 * @property boolean is_parent
 
 */
class Membership extends Model implements HasMedia
{
    use HasMediaTrait {
        getFirstMediaUrl as protected getFirstMediaUrlTrait;
    }

    use HasTranslations;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|max:127',
        'order' => 'nullable|numeric|min:0',
        'cost'=>'required',
        'validity_months'=>'required'

    ];
    public $translatable = [
        
    ];
    public $table = 'memberships';
    public $fillable = [
        'title',
        'cost',
        'value_offered',
        'discount',
        'validity_months',
        'thumbnail',
        'order',
        'type',
        'created_by',
        'updated_by'
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'cost' => 'integer',
        'value_offered' => 'integer',
        'discount' => 'integer',
        'validity_months' => 'integer',
        'thumbnail' =>'string',
        'type'=>'string',
        'order'=>'integer', 
        'created_by' => 'string',
        'updated_by'=>'string'
    ];
    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        'custom_fields',
        'has_media'
    ];

    protected $hidden = [
        "created_at",
        "updated_at",
    ];

    /**
     * to generate media url in case of fallback will
     * return the file type icon
     * @param string $conversion
     * @return string url
     */
    public function getFirstMediaUrl($collectionName = 'default', $conversion = '')
    {
        $url = $this->getFirstMediaUrlTrait($collectionName);
        $array = explode('.', $url);
        $extension = strtolower(end($array));
        if (in_array($extension, config('medialibrary.extensions_has_thumb'))) {
            return asset($this->getFirstMediaUrlTrait($collectionName, $conversion));
        } else {
            return asset(config('medialibrary.icons_folder') . '/' . $extension . '.png');
        }
    }

    public function getCustomFieldsAttribute()
    {
        $hasCustomField = in_array(static::class, setting('custom_field_models', []));
        if (!$hasCustomField) {
            return [];
        }
        $array = $this->customFieldsValues()
            ->join('custom_fields', 'custom_fields.id', '=', 'custom_field_values.custom_field_id')
            ->where('custom_fields.in_table', '=', true)
            ->get()->toArray();

        return convertToAssoc($array, 'name');
    }

    public function customFieldsValues()
    {
        return $this->morphMany('App\Models\CustomFieldValue', 'customizable');
    }

    /**
     * Add Media to api results
     * @return bool
     */
    public function getHasMediaAttribute()
    {
        return $this->hasMedia('image');
    }

    /**
     * @return BelongsTo
     **/
    
    /**
     * @return BelongsToMany
     **/
    
    public function discountables()
    {
        return $this->morphMany('App\Models\Discountable', 'discountable');
    }
}
