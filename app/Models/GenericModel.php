<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\GenericModel
 *
 * @mixin \Eloquent
 */
class GenericModel extends Model
{
    protected $table;
    protected $label;
    protected $sub_label;
    protected $primaryKey;
    protected $fields ;
    protected $view_edit ;
    protected $view_add ;
    protected $ajax_list_url = '';
    protected $view_list = 'admin.inc.cruds.list';
    protected $view_form = 'admin.inc.cruds.simple_form';
    protected $view_form_url = '';
    protected $view_form_post_url = '';
    protected $form_size = 'col-xl-12';
    protected $add_btn_label = 'Nouveau';
    protected $actions = [];
    protected $belongsTo = [];
    protected $belongsToMany = [];
    protected $dates = [];
    protected $dates_range = [];
    protected $datetimes_range = [];
    protected $datetimes = [];
    protected $times = [];
    protected $longTexts = [];
    protected $numbers = [];
    protected $emails = [];
    protected $telephones = [];
    protected $selects = [];
    protected $selects_key_values = [];
    protected $selects_multiple = [];
    protected $passwords = [];
    protected $hiddens= [];
    protected $columns_hiddens= [];
    protected $fields_hiddens= [];
    protected $other_models= [];
    protected $files= [];
    protected $images= [];
    protected $uploads_folder;
    protected $validate_methode = 'Validate';
    protected $rich_texts=[];
    protected $tag_inputs=[];
    protected $custom_bouttons=[];
    protected $custom_columns=[];
    protected $columns_in_actions=[];
    protected $steps_form=[];
    protected $separators=[];
    protected $colors=[];
    protected $groups_list=[];
    protected $tab_views=[];
    protected $form_custom_html=[];
    protected $showaction_column=true;
    protected $table_odering=true;
    protected $formRules = [];
    protected $formRequireds = [];
    protected $formRedirect = '';
    protected $customSingleActions = [];
    protected $columns_can_set_null = [];
    public $timestamps = true;
    protected $input_by_line=1;
    protected $searchFields = [];
    protected $searchRoute = '';
    protected $orderBys = [];
    protected $unexceptFiledsSearch = [];


    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    /**
     * @param string $primaryKey
     */
    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return mixed
     */
    public function getViewEdit()
    {
        return $this->view_edit;
    }

    /**
     * @param mixed $view_edit
     */
    public function setViewEdit($view_edit)
    {
        $this->view_edit = $view_edit;
    }

    /**
     * @return mixed
     */
    public function getViewAdd()
    {
        return $this->view_add;
    }

    /**
     * @param mixed $view_add
     */
    public function setViewAdd($view_add)
    {
        $this->view_add = $view_add;
    }

    /**
     * @return mixed
     */
    public function getViewList()
    {
        return $this->view_list;
    }

    /**
     * @param mixed $view_list
     */
    public function setViewList($view_list)
    {
        $this->view_list = $view_list;
    }

    /**
     * @return mixed
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @param mixed $actions
     */
    public function setActions($actions)
    {
        $this->actions = $actions;
    }

    /**
     * @return mixed
     */
    public function getBelongsTo()
    {
        return $this->belongsTo;
    }

    /**
     * @param mixed $belongsTo
     */
    public function setBelongsTo($belongsTo)
    {
        $this->belongsTo = $belongsTo;
    }

    /**
     * @return mixed
     */
    public function getBelongsToMany()
    {
        return $this->belongsToMany;
    }

    /**
     * @param mixed $belongsToMany
     */
    public function setBelongsToMany($belongsToMany)
    {
        $this->belongsToMany = $belongsToMany;
    }

    /**
     * @return mixed
     */
    public function getDates()
    {
        return $this->dates;
    }

    /**
     * @param mixed $dates
     */
    public function setDates($dates)
    {
        $this->dates = $dates;
    }

    /**
     * @return array
     */
    public function getTimes()
    {
        return $this->times;
    }

    /**
     * @param array $times
     */
    public function setTimes($times)
    {
        $this->times = $times;
    }




    /**
     * @return array
     */
    public function getLongTexts()
    {
        return $this->longTexts;
    }

    /**
     * @param array $longTexts
     */
    public function setLongTexts($longTexts)
    {
        $this->longTexts = $longTexts;
    }

    /**
     * @return array
     */
    public function getNumbers()
    {
        return $this->numbers;
    }

    /**
     * @param array $numbers
     */
    public function setNumbers($numbers)
    {
        $this->numbers = $numbers;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label): void
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getSubLabel()
    {
        return $this->sub_label;
    }

    /**
     * @param mixed $sub_label
     */
    public function setSubLabel($sub_label): void
    {
        $this->sub_label = $sub_label;
    }




    /**
     * @return array
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * @param array $emails
     */
    public function setEmails($emails)
    {
        $this->emails = $emails;
    }

    /**
     * @return array
     */
    public function getTelephones()
    {
        return $this->telephones;
    }

    /**
     * @param array $telephones
     */
    public function setTelephones($telephones)
    {
        $this->telephones = $telephones;
    }

    /**
     * @return array
     */
    public function getSelects()
    {
        return $this->selects;
    }

    /**
     * @param array $selects
     */
    public function setSelects($selects)
    {
        $this->selects = $selects;
    }

    /**
     * @return array
     */
    public function getSelectsMultiple()
    {
        return $this->selects_multiple;
    }

    /**
     * @param array $selects_multiple
     */
    public function setSelectsMultiple($selects_multiple)
    {
        $this->selects_multiple = $selects_multiple;
    }


    /**
     * @return array
     */
    public function getPasswords()
    {
        return $this->passwords;
    }

    /**
     * @param array $passwords
     */
    public function setPasswords($passwords)
    {
        $this->passwords = $passwords;
    }

    /**
     * @return array
     */
    public function getHiddens()
    {
        return $this->hiddens;
    }

    /**
     * @param array $hiddens
     */
    public function setHiddens($hiddens)
    {
        $this->hiddens = $hiddens;
    }

    /**
     * @return array
     */
    public function getOtherModels()
    {
        return $this->other_models;
    }

    /**
     * @param array $other_models
     */
    public function setOtherModels($other_models)
    {
        $this->other_models = $other_models;
    }

    /**
     * @return array
     */
    public function getColumnsHiddens()
    {
        return $this->columns_hiddens;
    }

    /**
     * @param array $columns_hiddens
     */
    public function setColumnsHiddens($columns_hiddens)
    {
        $this->columns_hiddens = $columns_hiddens;
    }

    /**
     * @return array
     */
    public function getFieldsHiddens()
    {
        return $this->fields_hiddens;
    }

    /**
     * @param array $fields_hiddens
     */
    public function setFieldsHiddens($fields_hiddens)
    {
        $this->fields_hiddens = $fields_hiddens;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param array $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }

    /**
     * @return mixed
     */
    public function getUploadsFolder()
    {
        return $this->uploads_folder;
    }

    /**
     * @param mixed $uploads_folder
     */
    public function setUploadsFolder($uploads_folder)
    {
        $this->uploads_folder = $uploads_folder;
    }

    /**
     * @return mixed
     */
    public function getValidateMethode()
    {
        return $this->validate_methode;
    }

    /**
     * @param mixed $validate_methode
     */
    public function setValidateMethode($validate_methode)
    {
        $this->validate_methode = $validate_methode;
    }

    /**
     * @return string
     */
    public function getFormModal()
    {
        return $this->form_modal;
    }

    /**
     * @param string $form_modal
     */
    public function setFormModal($form_modal)
    {
        $this->form_modal = $form_modal;
    }

    /**
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param array $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @return array
     */
    public function getDatetimes()
    {
        return $this->datetimes;
    }

    /**
     * @param array $datetimes
     */
    public function setDatetimes($datetimes)
    {
        $this->datetimes = $datetimes;
    }

    /**
     * @return array
     */
    public function getDatesRange()
    {
        return $this->dates_range;
    }

    /**
     * @param array $dates_range
     */
    public function setDatesRange($dates_range)
    {
        $this->dates_range = $dates_range;
    }

    /**
     * @return array
     */
    public function getDatetimesRange()
    {
        return $this->datetimes_range;
    }

    /**
     * @param array $datetimes_range
     */
    public function setDatetimesRange($datetimes_range)
    {
        $this->datetimes_range = $datetimes_range;
    }

    /**
     * @return array
     */
    public function getRichTexts()
    {
        return $this->rich_texts;
    }

    /**
     * @param array $rich_texts
     */
    public function setRichTexts($rich_texts)
    {
        $this->rich_texts = $rich_texts;
    }

    /**
     * @return array
     */
    public function getTagInputs()
    {
        return $this->tag_inputs;
    }

    /**
     * @param array $tag_inputs
     */
    public function setTagInputs($tag_inputs)
    {
        $this->tag_inputs = $tag_inputs;
    }

    /**
     * @return array
     */
    public function getCustomBouttons()
    {
        return $this->custom_bouttons;
    }

    /**
     * @param array $custom_bouttons
     */
    public function setCustomBouttons($custom_bouttons)
    {
        $this->custom_bouttons = $custom_bouttons;
    }

    /**
     * @return array
     */
    public function getCustomColumns()
    {
        return $this->custom_columns;
    }

    /**
     * @param array $custom_columns
     */
    public function setCustomColumns($custom_columns)
    {
        $this->custom_columns = $custom_columns;
    }

    /**
     * @return array
     */
    public function getColumnsInActions()
    {
        return $this->columns_in_actions;
    }

    /**
     * @param array $columns_in_actions
     */
    public function setColumnsInActions($columns_in_actions)
    {
        $this->columns_in_actions = $columns_in_actions;
    }

    /**
     * @return array
     */
    public function getStepsForm()
    {
        return $this->steps_form;
    }

    /**
     * @param array $steps_form
     */
    public function setStepsForm($steps_form)
    {
        $this->steps_form = $steps_form;
    }

    /**
     * @return array
     */
    public function getSeparators()
    {
        return $this->separators;
    }

    /**
     * @param array $separators
     */
    public function setSeparators($separators)
    {
        $this->separators = $separators;
    }

    /**
     * @return array
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * @param array $colors
     */
    public function setColors($colors)
    {
        $this->colors = $colors;
    }

    /**
     * @return array
     */
    public function getGroupsList()
    {
        return $this->groups_list;
    }

    /**
     * @param array $groups_list
     */
    public function setGroupsList($groups_list)
    {
        $this->groups_list = $groups_list;
    }

    /**
     * @return array
     */
    public function getTabViews()
    {
        return $this->tab_views;
    }

    /**
     * @param array $tab_views
     */
    public function setTabViews($tab_views)
    {
        $this->tab_views = $tab_views;
    }

    /**
     * @return array
     */
    public function getFormCustomHtml()
    {
        return $this->form_custom_html;
    }

    /**
     * @param array $form_custom_html
     */
    public function setFormCustomHtml($form_custom_html)
    {
        $this->form_custom_html = $form_custom_html;
    }

    /**
     * @return array
     */
    public function getSelectsKeyValues()
    {
        return $this->selects_key_values;
    }

    /**
     * @param array $selects_key_values
     */
    public function setSelectsKeyValues($selects_key_values)
    {
        $this->selects_key_values = $selects_key_values;
    }

    /**
     * @return bool
     */
    public function isShowactionColumn(): bool
    {
        return $this->showaction_column;
    }

    /**
     * @param bool $showaction_column
     */
    public function setShowactionColumn(bool $showaction_column): void
    {
        $this->showaction_column = $showaction_column;
    }

    /**
     * @return string
     */
    public function getFormSize(): string
    {
        return $this->form_size;
    }

    /**
     * @param string $form_size
     */
    public function setFormSize(string $form_size): void
    {
        $this->form_size = $form_size;
    }

    /**
     * @return string
     */
    public function getViewForm(): string
    {
        return $this->view_form;
    }

    /**
     * @param string $view_form
     */
    public function setViewForm(string $view_form): void
    {
        $this->view_form = $view_form;
    }

    /**
     * @return bool
     */
    public function isTableOdering(): bool
    {
        return $this->table_odering;
    }

    /**
     * @param bool $table_odering
     */
    public function setTableOdering(bool $table_odering): void
    {
        $this->table_odering = $table_odering;
    }

    /**
     * @return array
     */
    public function getFormRules(): array
    {
        return $this->formRules;
    }

    /**
     * @param array $formRules
     */
    public function setFormRules(array $formRules): void
    {
        $this->formRules = $formRules;
    }

    /**
     * @return array
     */
    public function getFormRequireds(): array
    {
        return $this->formRequireds;
    }

    /**
     * @param array $formRequireds
     */
    public function setFormRequireds(array $formRequireds): void
    {
        $this->formRequireds = $formRequireds;
    }

    /**
     * @return string
     */
    public function getFormRedirect(): string
    {
        return $this->formRedirect;
    }

    /**
     * @param string $formRedirect
     */
    public function setFormRedirect(string $formRedirect): void
    {
        $this->formRedirect = $formRedirect;
    }

    /**
     * @return array
     */
    public function getCustomSingleActions(): array
    {
        return $this->customSingleActions;
    }

    /**
     * @param array $customSingleActions
     */
    public function setCustomSingleActions(array $customSingleActions): void
    {
        $this->customSingleActions = $customSingleActions;
    }

    /**
     * @return array
     */
    public function getColumnsCanSetNull(): array
    {
        return $this->columns_can_set_null;
    }

    /**
     * @param array $columns_can_set_null
     */
    public function setColumnsCanSetNull(array $columns_can_set_null): void
    {
        $this->columns_can_set_null = $columns_can_set_null;
    }

    /**
     * @return array
     */
    public function getSearchFields(): array
    {
        return $this->searchFields;
    }

    /**
     * @param array $searchFields
     */
    public function setSearchFields(array $searchFields): void
    {
        $this->searchFields = $searchFields;
    }

    /**
     * @return string
     */
    public function getSearchRoute(): string
    {
        return $this->searchRoute;
    }

    /**
     * @param string $searchRoute
     */
    public function setSearchRoute(string $searchRoute): void
    {
        $this->searchRoute = $searchRoute;
    }

    /**
     * @return array
     */
    public function getOrderBys(): array
    {
        return $this->orderBys;
    }

    /**
     * @param array $orderBys
     */
    public function setOrderBys(array $orderBys): void
    {
        $this->orderBys = $orderBys;
    }

    /**
     * @return int
     */
    public function getInputByLine(): int
    {
        return $this->input_by_line;
    }

    /**
     * @param int $input_by_line
     */
    public function setInputByLine(int $input_by_line): void
    {
        $this->input_by_line = $input_by_line;
    }

    /**
     * @return string
     */
    public function getViewFormUrl(): string
    {
        return $this->view_form_url;
    }

    /**
     * @param string $view_form_url
     */
    public function setViewFormUrl(string $view_form_url): void
    {
        $this->view_form_url = $view_form_url;
    }

    /**
     * @return string
     */
    public function getAddBtnLabel(): string
    {
        return $this->add_btn_label;
    }

    /**
     * @param string $add_btn_label
     */
    public function setAddBtnLabel(string $add_btn_label): void
    {
        $this->add_btn_label = $add_btn_label;
    }

    /**
     * @return array
     */
    public function getUnexceptFiledsSearch(): array
    {
        return $this->unexceptFiledsSearch;
    }

    /**
     * @param array $unexceptFiledsSearch
     */
    public function setUnexceptFiledsSearch(array $unexceptFiledsSearch): void
    {
        $this->unexceptFiledsSearch = $unexceptFiledsSearch;
    }

    /**
     * @return string
     */
    public function getAjaxListUrl(): string
    {
        return $this->ajax_list_url;
    }

    /**
     * @param string $ajax_list_url
     */
    public function setAjaxListUrl(string $ajax_list_url): void
    {
        $this->ajax_list_url = $ajax_list_url;
    }

    /**
     * @return string
     */
    public function getViewFormPostUrl(): string
    {
        return $this->view_form_post_url;
    }

    /**
     * @param string $view_form_post_url
     */
    public function setViewFormPostUrl(string $view_form_post_url): void
    {
        $this->view_form_post_url = $view_form_post_url;
    }



}
