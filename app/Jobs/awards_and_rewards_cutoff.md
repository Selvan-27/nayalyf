

LEVEL    RP ID COUNT    1ST CUT RANK TO MEMBER            2ND CUT RANK TO MEMBER            3rd CUT RANK TO MEMBER         REWARDS LIST
-------------------------------------------------------------------------------------------------------------------------------------------
0        0             UCWC DISTRIBUTOR                   UCWC DISTRIBUTOR                  UCWC DISTRIBUTOR               0
1        2             Bronze Wellness Warrior Eligible 1 Bronze Wellness Warrior Eligible 2 Bronze Wellness Warrior       0
2        6             Silver Star Achiever Eligible 1    Silver Star Achiever Eligible 2    Silver Star Achiever          0
3        18            Gold Elite Performer Eligible 1    Gold Elite Performer Eligible 2    Gold Elite Performer          0
4        54            Platinum Pioneer Eligible 1        Platinum Pioneer Eligible 2        Platinum Pioneer              0
5        162           Pearl of Excellence Eligible 1     Pearl of Excellence Eligible 2     Pearl of Excellence           KERALA TOUR LIST
6        486           Dynamic Distributor Eligible 1     Dynamic Distributor Eligible 2     Dynamic Distributor           GOA TOUR LIST
7        1458          UCWC Ambassador Eligible 1         UCWC Ambassador Eligible 2         UCWC Ambassador               GADGETS LIST
8        4374          Diamond Ambassador Eligible 1      Diamond Ambassador Eligible 2      Diamond Ambassador            THAILAND TOUR LIST
9        13122         Elite Ambassador Eligible 1        Elite Ambassador Eligible 2        Elite Ambassador              GOLD LIST
10       39366         Titan Ambassador Eligible 1        Titan Ambassador Eligible 2        Titan Ambassador              CRUISE TOUR LIST
11       118098        Double Diamond Director Eligible 1 Double Diamond Director Eligible 2 Double Diamond Director       CAR LIST
12       354294        Double Elite Director Eligible 1   Double Elite Director Eligible 2   Double Elite Director         DUBAI TOUR LIST
13       1062882       Double Titan Director Eligible 1   Double Titan Director Eligible 2   Double Titan Director         LUXURY CAR LIST
14       3188646       Crown Director Eligible 1          Crown Director Eligible 2          Crown Director                LUXURY VILLA LIST



this cutoff works similar to repurchase cutoff. but this one won't generate any income but will give ranks to users.

there will be fixed slots for cutoff with from date and to date in table name "awards_and_rewards_cutoff_slots"

level 0 is nothing but for new member without achiving anything.

Level 1
--------
during a cutoff period a user achieved two or more repurchase ids in his first level then he achieved "Bronze Wellness Warrior Eligible 1"

if he did that again then he reaches "Bronze Wellness Warrior Eligible 2" 

when he achieves third time then he reaches "Bronze Wellness Warrior". he doesn't have to acheive these in consequtive cuttoffs.

Level 2 
----------

to achieve "Silver Star Achiever Eligible 1" he need to get 6 or more repurchase ids in level2 . And also he have to reach
2 or more repurchase ids in level 1 also. in that cutoff slot period. 

like this the rewards will go on. 

when someone reaches "Pearl of Excellence". he will be awared "kerala_tour". save this in separete table named "awarded_members" with columns memberid, and in the "award" column save the "kerala_tour" tag
he can achieve the same rank again and agin and got rewarded in up coming cutoffs . and the rewards will be added. 

need to update the user's current rank so that it can be displayed. having a seprate table for rank_list is a good option. 

