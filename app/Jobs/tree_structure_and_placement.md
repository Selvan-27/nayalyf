**Product Requirements Document (PRD)**

**Module:** MLM Tree Structure & Placement Logic

---

### 1. Overview
This module defines the structural rules and placement logic for member IDs and rebirth IDs across four tree groups in the MLM system. It includes entry conditions, filling algorithms, rebirth propagation, and tree progression mechanics.

---

### 2. Tree Groups Summary

| Tree Group         | No. of Trees | Filling Method   | Rebirths Allowed        |
|--------------------|--------------|------------------|--------------------------|
| Global Tree Group  | 5            | Global Filling   | Yes (full-cycle rebirths) |
| Team Tree Group    | 14           | Team Filling     | Yes                      |
| Achievement Tree   | 1            | Team Filling     | Yes                      |
| Fast Track Group   | 2            | Global Filling   | Yes (local rebirth loop) |

---

### 3. ID Entry Rules

- **Regular ID Entry:**
  - Upon registration:
    - Triggers IGNITE bonus to referrer.
    - Enters Tree #1 of: Team Tree Group, Global Tree Group, and Achievement Tree Group.
  - Once it has **3 direct referrals**, it enters Tree #1 of the Fast Track Tree Group.

- **Rebirth ID from Global Tree:**
  - Generated when an ID completes Tree #5 in Global Group **and** gets 3 direct children.
  - Behaves like a new ID:
    - Enters Tree #1 of Team, Global, Achievement.
    - Enters Fast Track **only if original ID had qualified**.
    - Has no login access.

- **Rebirth ID from Fast Track (Local Rebirth):**
  - Triggered when any ID (original or rebirth) in **Tree #2 of Fast Track Group** gets 3 direct children.
  - Spawns **2 rebirth IDs**.
  - Both are placed into **Tree #1 of Fast Track Group only**.
  - Do not enter Team, Global, or Achievement trees.
  - Infinite recursion allowed.

---

### 4. Filling Algorithms

- **Global Filling:**
  - Starts from the very first ID in the group (root).
  - Follows breadth-first, left-to-right traversal.
  - Places new ID in the first available node with <3 children.

- **Team Filling:**
  - Starts from the sponsor ID of the new member.
  - If sponsor has 3 children, search proceeds downward through that subtree.
  - Uses breadth-first, left-to-right traversal within sponsor lineage.

---

### 5. Tree Progression Rules

- For all tree groups:
  - An ID progresses from one tree to the next **only after reaching 3 direct children** in the current tree.
  - Rebirth is triggered (if applicable) upon completing the final tree of that group.

---

### 6. Special Notes

- **Fast Track Looping:**
  - Once an original ID enters Fast Track, **all future rebirths** from Global Tree linked to that ID **automatically enter Fast Track** as well.
  - These rebirths follow standard global filling inside Fast Track Group.

- **Rebirth Tree Tracing:**
  - Every rebirth must track both:
    - Immediate parent ID.
    - Root/original ID that started the chain.

---

### End of Document
This PRD section is now ready to integrate into the overall MLM system spec. Income logic to follow in a separate module.

