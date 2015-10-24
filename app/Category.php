<?php namespace app;

use App\Collection\Categories;
use App\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'icon',
        'image',
        'status',
        'type'
    ];

    /**
     * The attributes to append.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * Select if return the categories family tree.
     *
     * @var boolean
     */
    protected $family_tree = false;

    /**
     * Override Collection Method.
     * @param  array  $models
     * @return Categories Collection
     */
    public function newCollection(array $models = array())
    {
        return new Categories($models);
    }

    public function product()
    {
        return $this->hasMany('App\Product');
    }

    public function category()
    {
        return $this->hasMany('App\Category');
    }
    
    /**
     * Return a collection of a category's childs, or null if don't have
     * @return collection
     */
    public function getChildsAttribute()
    {
        $childs=$this->hasMany('App\Category')->orderBy('name')->get();
        if (!count($childs)) {
            $childs=null;
        } elseif ($this->family_tree) {
            $childs->each(function ($cat) { $cat->withFamilyTree(); });
        }
        return $childs;
    }
    /**
     * Return the parent of a category, or null if don't have
     * @return category model
     */
    public function getParentAttribute()
    {
        return $this->belongsTo('App\Category', 'category_id')->first();
    }
    /**
     * Return the the full tree of parents of a category, or null if don't have.
     * The tree contains the master parent, and a child attribute that contains next element,
     * up to
     * @return category model
     */
    public function getParentTreeAttribute()
    {
        if (!$this->hasParent()) {
            return null;
        }
        #family tree (return all category parents)
        $tree=$this->parent;
        $tree->child=null;
        while ($tree->hasParent()) {
            $new=$tree->parent;
            $new->child=$tree;
            $tree=$new;
        }
        return $tree;
    }

    public function hasChilds()
    {
        return !!count($this->childs);
    }
    public function hasChildren()
    {
        return isset($this->children)&&count($this->children);
        // $parent=$this->hasMany('App\Category')->get();
        // return !!count($parent);
    }
    public function hasParent()
    {
        return !!count($this->parent);
    }

    public function withChilds()
    {
        // if (!in_array('childs', $this->appends)) {
        //     $this->appends[]='childs';
        // }
        return $this;
    }

    public function withFamilyTree($value=true)
    {
        $children=Category::childsOf($this->id)->get();
        if ($children->count()) {
            $this->children=$children->buildTree();
        }
        return $this;
    }
    public function withParentTree()
    {
        if (!in_array('parent_tree', $this->appends)) {
            $this->appends[]='parent_tree';
        }
        return $this;
    }

    public function scopeSearch($query, $name)
    {
        if (trim($name) != '') {
            $query->where('name', 'LIKE', "%$name%");
        }
    }

    public function scopeByName($query)
    {
        return $query->orderBy('name');
    }

    public function scopeActives($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInactives($query)
    {
        return $query->where('status', 0);
    }

    /**
     * return all the childs of a category. If the id is empty, 'parents' or 'mothers',
     * then return the main categories.
     * @param  $query
     * @param  $id    category id, empty value, 'parents' or 'mothers'
     * @return $query
     */
    public function scopeChildsOf($query, $id)
    {
        if (!$id || $id=='parent' || $id=='mothers') {
            return $query->whereNull('category_id');
        } else {
            return $query->where('category_id', $id);
        }
    }

    public function scopeMothers($query)
    {
        return $query->whereNull('category_id');
    }
    public function scopeStore($query)
    {
        return $query->where('type', 'store');
    }
    public function scopeGroup($query)
    {
        return $query->where('type', 'group');
    }
    public function scopeFull($query)
    {
        return $query->where(\DB::raw(0), '<', function ($sql) {
            $sql->select(\DB::raw('COUNT(products.id)'))->from('products')->whereRaw('categories.id=products.category_id');
        });
    }
    public function scopeLightSelection($query)
    {
        return $query->select('categories.id', 'categories.name', 'categories.category_id');
    }
   
    /**
     * $id category to searh progeny , $list array to use, $fields that you need
     */
    public static function progeny($id, &$list, $fields = ['id', 'name'])
    {
        $childs = Category::childsOf($id)->select($fields)->get();

        if (is_null($childs)) {
            return;
        }

        foreach ($childs as $value) {
            $list[]=$value->toArray();

            Category::progeny($value->id, $list, $fields);
        }
        return;
    }
}
