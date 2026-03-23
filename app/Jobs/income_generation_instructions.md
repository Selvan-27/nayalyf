**Product Requirements Document (PRD)**

**Module:** MLM Income Logic – Reignite, Team Performance, Global Bonus & Fast Track Income

---

### 1. Overview

This module defines how income is generated, calculated, and stored in relation to rebirth events and tree placements within the MLM system. It includes logic for Reignite Income, Team Performance Income, Global Bonus Income, and Fast Track Income.

---

### 2. Income Type: Reignite Income

* **Trigger Condition:**

  * Every time a **rebirth ID is generated** in the **Global Tree Group** (i.e., when an ID completes Tree #5 and gains 3 direct children).

* **Beneficiary:**

  * The **original root ID** from which the rebirth chain originated.

* **Amount Credited:**

  * A fixed amount of **INR ₹160** is credited per rebirth trigger.

* **Transaction Logging:**

  * Each payment is recorded as a transaction in the `re_ignite_income` table.

* **Database Schema Update:**

  * `re_ignite_income` table fields:

    * `id` (PK)
    * `original_id` (FK to member table)
    * `rebirth_id` (FK to member table)
    * `amount` (default: 160)
    * `created_at` (timestamp)

* **Business Rule:**

  * No income is credited for Fast Track local rebirths; this logic applies **only to Global Tree rebirths**.

---

### 3. Income Type: Team Performance Income

* **Trigger Condition:**

  * Every time a new node is placed in the **Team Tree Group** using the team filling algorithm.

* **Logic Details:**

  * When a new node is added as the **3rd child of member X**, the **parent of X** receives a payout.
  * If the new node is the **4th or 5th node** (relative to X, as found by continuing the team filling traversal), **X** receives a payout.
  * If the new node is the **6th node**, the **parent of X** again receives a payout.
  * This cycle continues infinitely:

    * 3rd → parent of X
    * 4th/5th → X
    * 6th → parent of X
    * 7th/8th → X
    * 9th → parent of X
    * etc.

* **Amount by Tree Number:**

  * The income varies based on the tree number (1 through 14) in the Team Tree Group:

    * Tree 1: ₹200
    * Tree 2: ₹400
    * Tree 3: ₹800
    * Tree 4: ₹1600
    * Tree 5: ₹3200
    * Tree 6: ₹6400
    * Tree 7: ₹12,800
    * Tree 8: ₹25,600
    * Tree 9: ₹51,200
    * Tree 10: ₹1,02,400
    * Tree 11: ₹2,04,800
    * Tree 12: ₹4,09,600
    * Tree 13: ₹8,19,200
    * Tree 14: ₹16,38,400

* **Transaction Logging:**

  * Each payment is recorded in the `team_performance_income` table.

* **Database Schema Update:**

  * `team_performance_income` table fields:

    * `id` (PK)
    * `beneficiary_id` (FK to member table)
    * `trigger_node_id` (FK to member table)
    * `reference_node_id` (X in the cycle)
    * `position_in_cycle` (3, 4, 5, 6, etc.)
    * `tree_number` (1 to 14)
    * `amount` (variable by tree)
    * `created_at` (timestamp)

* **Traversal Method:**

  * Same breadth-first, left-to-right logic as team filling.
  * Must track each position incrementally to apply the correct cycle rule and resolve the tree number contextually.

---

### 4. Income Type: Global Bonus Income

* **Trigger Condition:**

  * Every time a new node is placed in the **Global Tree Group** using global filling logic.

* **Logic Details:**

  * Same cycle pattern as Team Performance:

    * 3rd node → parent of X gets paid
    * 4th/5th → X gets paid
    * 6th → parent of X gets paid
    * Continues infinitely in repeating pattern.

* **Amount by Tree Number:**

  * The income varies based on the tree number (1 through 5) in the Global Tree Group:

    * Tree 1: ₹125
    * Tree 2: ₹250
    * Tree 3: ₹500
    * Tree 4: ₹1000
    * Tree 5: ₹2000

* **Transaction Logging:**

  * Each payment is recorded in the `global_bonus_income` table.

* **Database Schema Update:**

  * `global_bonus_income` table fields:

    * `id` (PK)
    * `beneficiary_id` (FK to member table)
    * `trigger_node_id` (FK to member table)
    * `reference_node_id` (X in the cycle)
    * `position_in_cycle` (3, 4, 5, 6, etc.)
    * `tree_number` (1 to 5)
    * `amount` (variable by tree)
    * `created_at` (timestamp)

* **Traversal Method:**

  * Same as global filling: breadth-first, left-to-right.

---

### 5. Income Type: Fast Track Bonus Income

* **Trigger Condition:**

  * When a node (original or rebirth) in the Fast Track Tree Group reaches **three direct children**.

* **Logic Details:**

  * One-time payout per Fast Track tree level, once the condition is met.

* **Amount by Tree Number:**

  * Tree 1: ₹125
  * Tree 2: ₹500

* **Transaction Logging:**

  * Each payment is recorded in the `fast_track_income` table.

* **Database Schema Update:**

  * `fast_track_income` table fields:

    * `id` (PK)
    * `beneficiary_id` (FK to member table)
    * `tree_number` (1 or 2)
    * `amount` (variable by tree)
    * `created_at` (timestamp)

---

### 6. Audit & Tracking

* All rebirth and placement events must be logged with traceable reference IDs.
* Income tables must allow back-tracing to triggering events.

---

### 7. Future Considerations

* Option to configure income amounts and cycle patterns via admin interface.
* Real-time tree-wise bonus tracking dashboard.

---

### End of Document

This PRD defines the Reignite Income, Team Performance Income, Global Bonus Income, and Fast Track Bonus Income logic, ready for integration with tree placement modules. Additional income types will be documented in separate modules.
