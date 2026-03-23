**Product Requirements Document (PRD)**

**Module:** MLM Income Logic – Team Performance Income (Revised, Count‑Based Cascade)

---

### 1. Overview

Defines the **Team Performance Income** logic based on **income count**, not the nth child. Income is triggered when a node gains a **direct child** in the **Team Tree Group (14 trees)**, then may **cascade upward** depending on each ancestor’s **income count**.

---

### 2. Key Definitions

* **placement event**: a new node is placed under parent **P** in a Team Tree.
* **income\_count(X)**: total number of income events attributed to node **X** (including cascaded incomes received from descendants). This counter drives who finally receives each payout.
* **beneficiary**: the node that ultimately receives the money for a given placement event in a given tree.

---

### 3. Trigger & Cascade Flow (Authoritative Logic)

**On every placement event under parent P:**

1. **Increment P’s income\_count** by **1** (this creates an income event for **P** in the current tree).
2. **Attribution rule (count-based):**

   * If **income\_count(P) % 3 ≠ 0** → the **payout stays with P** (beneficiary = P). **Stop.**
   * If **income\_count(P) % 3 = 0** → the payout is **passed upward** to **parent(P)**.
3. **Cascade upward:** when a payout is passed to **A = parent(P)**:

   * **Increment income\_count(A)** by **1** (this event also counts for A).
   * If **income\_count(A) % 3 ≠ 0** → **A keeps** the payout. **Stop.**
   * If **income\_count(A) % 3 = 0** → **pass upward** again to **parent(A)** and repeat.
4. **Root handling:** if the cascade reaches the **root** and its updated **income\_count(root) % 3 = 0**, the **root still receives** and records the payout (no further parent to pass to).

> **Notes**
>
> * Cascading can pass through multiple ancestors **in a single placement** if updated counts at successive levels are multiples of 3.
> * Only the **direct parent P** is incremented at step 1. Ancestors are incremented **only when** a payout is passed to them by the rule above.
> * This logic is **independent of “nth child” positions**; only **income counts** determine pass/keep.

---

### 4. Amount by Team Tree Number (unchanged)

Payout amount depends on the **Team Tree index** where the placement occurred:

* Tree 1: ₹200
* Tree 2: ₹400
* Tree 3: ₹800
* Tree 4: ₹1,600
* Tree 5: ₹3,200
* Tree 6: ₹6,400
* Tree 7: ₹12,800
* Tree 8: ₹25,600
* Tree 9: ₹51,200
* Tree 10: ₹1,02,400
* Tree 11: ₹2,04,800
* Tree 12: ₹4,09,600
* Tree 13: ₹8,19,200
* Tree 14: ₹16,38,400

> The **amount** is tied to the **tree where the placement occurred**, not where the beneficiary resides.

---

### 5. Worked Example (A → B,C,D → E,F,G → H,J)

**Insertion order:** B, C, D, E, F, G, H, J (team filling).

* **A’s first three incomes** arise from its **direct children** B, C, D (counts 1, 2, 3). For the **3rd income**, A has no parent; by rule it **still keeps** it.
* **E** added under **B** → increments **income\_count(B)** to 1 → B keeps it.
* **H** added under **B** → increments **income\_count(B)** to 2 → B keeps it.
* **J** added under **B** → increments **income\_count(B)** to 3 → multiple of 3, so **pass to A**. When received by **A**, **increment A’s count**; if that makes A’s count a multiple of 3, A would pass again (else A keeps).
* **Variant:** if only **H** is added under **B**, and **E** receives three direct children:

  * E’s 3rd income (from its own 3rd child) → passes to **B** (incrementing **B**); if that makes **B**’s count a multiple of 3, it **passes to A** in the same event, incrementing **A** as well.

This demonstrates **count-based** cascading independent of child ordering.

---

**Counters:**

* Maintain `income_count` per member **per Team Tree number** (recommended), or clearly define scope (global vs per-tree). *Default: per-tree* to avoid cross-tree interference.

---

### 7. Processing Pseudocode (Reference)

```
function handleTeamPlacement(placementNode, parentP, treeNumber):
  amount = amountByTree(treeNumber)
  cascade = []

  # Step 1: parent P gets an income event
  P.income_count[treeNumber] += 1
  cascade.append({node: P, income_count_after: P.income_count[treeNumber], action: 'evaluate'})

  current = P
  while true:
    if current.income_count[treeNumber] % 3 != 0:
      beneficiary = current
      cascade[-1].action = 'keep'
      break
    else:
      # pass upward
      parent = current.parent
      if parent == null:
        beneficiary = current  # root keeps it even if multiple of 3
        cascade[-1].action = 'keep'
        break
      current = parent
      current.income_count[treeNumber] += 1
      cascade.append({node: current, income_count_after: current.income_count[treeNumber], action: 'evaluate'})

  logTeamIncome(placementNode, P, beneficiary, treeNumber, amount, cascade)
```

---

### 8. Business Rules

* Applies to **all IDs** (regular and rebirth) placed in Team Trees.
* **Unlimited** cascade depth per placement, bounded by tree height.
* **Idempotency:** replays of the same placement event must not duplicate payouts.

---

### 9. QA Scenarios

* Node with income\_count=2 receives a new child → keeps payout (count becomes 3? No, becomes 3 then passes; ensure correct!)
* Multi-level cascade where child’s 3rd income makes parent’s 3rd income which makes grandparent’s 3rd income.
* Root handling when root’s updated count is multiple of 3.
* Cross-tree isolation of counters.

---

### End of Document
