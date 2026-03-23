
### 1. Tables/model to use

 team_performance_tree, global_tree , achievement_tree , fast_track_tree. 

 For every tree group with more than one tree use the same table to add members. use "tree_no" column to differenciate. 

 If model is not there then create one in the exact same name with tree name. use the same name format like this "team_performance_tree".

 the mlm_plan tree is to save the sponsor_id details . in that tree "referral_count" column to track the number of direct referrals. "memberid_type" to store "rebirth/regular". only the rebirths from the "global_tree" will come to mlm_plan table. "status" column to store activation status (0 or 1). 

