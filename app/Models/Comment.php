<?php

namespace App\Models;

use App\Filament\Traits\InputsTrait;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\MorphToSelect\Type;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Comment extends Model
{
    use HasFactory;

    public $fillable =['user_id','comment','commentable_type','commentable_id'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function  user()
    {
        return $this->belongsTo(User::class);
    }

    public function  posts()
    {
        return $this->belongsTo(User::class);
    }

    public static function getForm() 
    {

        return [
            Section::make()
           ->schema([
               Section::make()->schema([
                
                InputsTrait::select('user_id', __('Name') , 'user' , 'name' ),
               
                InputsTrait::input('comment' , __('Comment') , __('Enter Comment'),'heroicon-m-chat-bubble-bottom-center-text')->columns(2),
   
                MorphToSelect::make('commentable')
                ->label(__('Comment Tybe'))
                ->required()
                ->types([
                    Type::make(User::class)->titleAttribute('email')->label(__('User')),
                    Type::make(Comment::class)->titleAttribute('comment')->label(__('Comment')),
                ]),
               ]),
               
   
            ]),
        ];    
    }

}
