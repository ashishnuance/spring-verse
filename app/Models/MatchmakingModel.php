<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchmakingModel extends Model
{
    use HasFactory;
    protected $table="matchmaking";
    protected $primaryKey="id";
    protected $fillable = ['first_name','last_name','city','brainstorm_with_peers','grow_your_team','start_a_company','business_development','invest','explore_new_projects','mentor_others','organize_events','raise_funding','find_a_cofounder','meet_interesting_people','explore_new_perspectives','find_a_job','entrepreneurship','marketing','sales','consulting','e-commerce','retail','real_estate','angel_investing','crypto','quant_finance','venture_capital','investment_banking','economics','travel','fitness','food','gaming','writing','reading','dinner_parties','poker','chess','cooking','wellness','parenting','ai','biohacking','machine_learning','product_design','programming_languages','vr_ar','product_management','robotics','fintech','data_science','life_sciences','visual_design','social_impact','diversity_and_inclusion','education','sustainability','volunteering','philanthropy','human_rights','photography','music','sports','film','entertainment','media','electronic_music','cinematography','fishing','skiing','fashion','running','images','linkedin_url','introduction','learn_about','ask_me','top_mind','something_learn','hustle','member_id'];


    public function user(){
        return $this->hasOne('App\Models\User','id','member_id')->select(['id','username','full_name']);
    }
}