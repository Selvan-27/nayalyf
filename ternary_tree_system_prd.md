# **Product Requirements Document (PRD)**
## **Ternary Tree Display System for MLM Platforms**

### **1. Overview**
This system provides a comprehensive solution for displaying and navigating ternary (3-child) tree structures in MLM applications. It supports multiple tree types with different filling algorithms, interactive navigation, and dynamic level counting.

---

### **2. System Architecture**

#### **2.1 Core Components**
- **Backend Controller**: Laravel controller handling tree data retrieval and processing
- **Frontend Blade Templates**: Dynamic tree rendering with Bootstrap tabs
- **JavaScript Navigation**: Tab persistence and interactive features
- **Database Schema**: Standardized tree table structure

#### **2.2 Tree Structure**
- **Node Capacity**: Each node supports exactly 3 children (positions: p1, p2, p3)
- **Display Levels**: Shows 3 levels (root + 2 child levels) simultaneously
- **Navigation**: Click-to-navigate functionality for exploring deeper levels

---

### **3. Tree Types & Configurations**

| Tree Type | Number of Boards | Filling Method | Database Table | Level Counting |
|-----------|------------------|----------------|----------------|----------------|
| Team Performance | 15 | Team Filling | `team_performance_tree` | No |
| Global Tree | 5 | Global Filling | `global_tree` | No |
| Fast Track | 2 | Global Filling | `fast_track_tree` | No |
| Achievement | 1 | Team Filling | `achievement_tree` | No |

---

### **4. Filling Algorithms**

#### **4.1 Global Filling (Breadth-First)**
- Starts from the absolute root of the tree group
- Fills positions left-to-right: p1 → p2 → p3
- Moves to next level only when current level is complete
- Used by: Global Tree, Fast Track Tree

#### **4.2 Team Filling (Sponsor-Based)**
- Starts from the sponsor's position in the tree
- Fills downward through sponsor's lineage
- Follows breadth-first within sponsor subtree
- Used by: Team Performance Tree, Achievement Tree

---

### **5. Database Schema**

#### **5.1 Standard Tree Table Structure**
```sql
CREATE TABLE `{tree_type}_tree` (
    `id` bigint PRIMARY KEY AUTO_INCREMENT,
    `memberid` varchar(255) NOT NULL,
    `placement_id` varchar(255), -- Parent node ID
    `pos` enum('p1','p2','p3'), -- Position under parent
    `tree_no` int NOT NULL, -- Board/Tree number
    `created_at` timestamp,
    `updated_at` timestamp,
    
    INDEX `idx_memberid_treeno` (`memberid`, `tree_no`),
    INDEX `idx_placement_pos_treeno` (`placement_id`, `pos`, `tree_no`)
);
```

#### **5.2 Required Supporting Table**
```sql
CREATE TABLE `mlm_plan` (
    `id` bigint PRIMARY KEY AUTO_INCREMENT,
    `memberid` varchar(255) NOT NULL,
    -- Other member fields
);
```

---

### **6. Controller Implementation**

#### **6.1 Core Methods Pattern**
```php
public function {tree_type}_tree(Request $request) {
    $all_trees = [];
    for ($tree_no = 1; $tree_no <= {max_trees}; $tree_no++) {
        $root = $request->input('root_' . $tree_no);
        if (!$root) {
            $root = DB::table('mlm_plan')->orderBy('id')->value('memberid');
        }
        
        $root_node = DB::table('{tree_type}_tree')
            ->where('memberid', $root)
            ->where('tree_no', $tree_no)
            ->first();
            
        if (!$root_node) {
            $all_trees[$tree_no] = null;
            continue;
        }
        
        $tree = $this->get{TreeType}TernaryTree($root_node, $tree_no, 2);
        $all_trees[$tree_no] = $tree;
    }
    
    // Optional: Level counting for specific tree types
    if (in_array('{tree_type}', ['achievement', 'team_performance'])) {
        $level_counts = $this->get{TreeType}LevelCounts($root, 1);
        return view('tree{type}', ['all_trees' => $all_trees, 'level_counts' => $level_counts]);
    }
    
    return view('tree{type}', ['all_trees' => $all_trees]);
}
```

#### **6.2 Recursive Tree Builder**
```php
private function get{TreeType}TernaryTree($node, $tree_no, $levels) {
    if ($levels < 0 || !$node) return null;
    
    $children = [];
    foreach (["p1", "p2", "p3"] as $pos) {
        $child = DB::table('{tree_type}_tree')
            ->where('placement_id', $node->memberid)
            ->where('pos', $pos)
            ->where('tree_no', $tree_no)
            ->first();
        $children[$pos] = $child ? $this->get{TreeType}TernaryTree($child, $tree_no, $levels - 1) : null;
    }
    
    return [
        'node' => $node,
        'children' => $children
    ];
}
```

#### **6.3 Level Counter (Optional)**
```php
private function get{TreeType}LevelCounts($root_memberid, $tree_no) {
    $level_counts = array_fill(1, 15, 0);
    
    // Start with root node's children as level 1
    $current_level_nodes = DB::table('{tree_type}_tree')
        ->where('placement_id', $root_memberid)
        ->where('tree_no', $tree_no)
        ->whereIn('pos', ['p1', 'p2', 'p3'])
        ->pluck('memberid')
        ->toArray();
    
    for ($level = 1; $level <= 15; $level++) {
        if (empty($current_level_nodes)) break;
        
        $level_counts[$level] = count($current_level_nodes);
        $next_level_nodes = [];
        
        foreach ($current_level_nodes as $parent_id) {
            $children = DB::table('{tree_type}_tree')
                ->where('placement_id', $parent_id)
                ->where('tree_no', $tree_no)
                ->whereIn('pos', ['p1', 'p2', 'p3'])
                ->pluck('memberid')
                ->toArray();
            
            $next_level_nodes = array_merge($next_level_nodes, $children);
        }
        
        $current_level_nodes = $next_level_nodes;
    }
    
    return $level_counts;
}
```

---

### **7. Frontend Templates**

#### **7.1 Multi-Board Layout (Team/Global/Fast Track)**
```php
<!-- Bootstrap Tabs for Multiple Boards -->
<ul class="nav nav-tabs nav-material">
    @for ($i = 1; $i <= {max_boards}; $i++)
    <li class="nav-item">
        <a class="nav-link{{ $i == 1 ? ' active' : '' }}" 
           id="b{{ $i }}-tab" 
           data-bs-toggle="tab" 
           href="#top-b{{ $i }}">
           {Tree Type} Board {{ $i }}
        </a>
    </li>
    @endfor
</ul>

<!-- Tab Content -->
<div class="tab-content">
    @for ($i = 1; $i <= {max_boards}; $i++)
    <div class="tab-pane fade{{ $i == 1 ? ' show active' : '' }}" 
         id="top-b{{ $i }}">
        <table class="table table-responsive text-center">
            @php
                $tree = $all_trees[$i] ?? null;
                render{TreeType}TreeRow($tree, 0, $i);
            @endphp
        </table>
    </div>
    @endfor
</div>
```

#### **7.2 Single Board Layout (Achievement)**
```php
<!-- Accordion Layout for Single Board -->
<div class="row">
    <div class="col-lg-2">
        <!-- Level Count Table -->
        <table class="table table-responsive text-center">
            <thead>
                <tr><th>Level</th><th>Members</th></tr>
            </thead>
            <tbody>
                @for($i = 1; $i <= 15; $i++)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $level_counts[$i] ?? 0 }}</td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
    <div class="col-lg-10">
        <!-- Tree Display -->
        <div class="card">
            <div class="card-body">
                <table class="table table-responsive text-center">
                    @php
                        $tree = $all_trees[1] ?? null;
                        renderAchievementTreeRow($tree);
                    @endphp
                </table>
            </div>
        </div>
    </div>
</div>
```

#### **7.3 Tree Rendering Function**
```php
@php
function render{TreeType}TreeRow($tree, $level = 0, $parentTreeNo = 1) {
    // Root node (centered)
    echo '<tr>';
    for ($j = 0; $j < 4; $j++) echo '<td></td>';
    
    if ($tree && isset($tree['node'])) {
        $node = $tree['node'];
        echo '<td>';
        echo '<a href="?root_' . $parentTreeNo . '=' . $node->memberid . '">';
        echo '<img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">';
        echo '<p>' . $node->memberid . '</p>';
        echo '</a>';
        echo '</td>';
    } else {
        echo '<td>';
        echo '<img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/0.jpg" alt="">';
        echo '<p>Vacant</p>';
        echo '</td>';
    }
    
    for ($j = 0; $j < 4; $j++) echo '<td></td>';
    echo '</tr>';
    
    // Children level (3 nodes)
    echo '<tr>';
    echo '<td></td>';
    $children = ($tree && isset($tree['children'])) ? $tree['children'] : [];
    foreach (["p1", "p2", "p3"] as $pos) {
        if (isset($children[$pos]) && $children[$pos]) {
            $child = $children[$pos];
            $node = $child['node'];
            echo '<td>';
            echo '<a href="?root_' . $parentTreeNo . '=' . $node->memberid . '">';
            echo '<img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">';
            echo '<p>' . $node->memberid . '</p>';
            echo '</a>';
            echo '</td>';
        } else {
            echo '<td>';
            echo '<img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/0.jpg" alt="">';
            echo '<p>Vacant</p>';
            echo '</td>';
        }
        if ($pos != "p3") echo '<td></td><td></td>';
    }
    echo '</tr>';
    
    // Grandchildren level (9 nodes)
    echo '<tr>';
    $grandchildren = [];
    foreach (["p1", "p2", "p3"] as $pos) {
        if (isset($children[$pos]) && $children[$pos] && isset($children[$pos]['children'])) {
            $grandchildren[$pos] = $children[$pos]['children'];
        } else {
            $grandchildren[$pos] = null;
        }
    }
    
    foreach (["p1", "p2", "p3"] as $pos) {
        if ($grandchildren[$pos]) {
            foreach (["p1", "p2", "p3"] as $gpos) {
                if (isset($grandchildren[$pos][$gpos]) && $grandchildren[$pos][$gpos]) {
                    $gchild = $grandchildren[$pos][$gpos]['node'];
                    echo '<td>';
                    echo '<a href="?root_' . $parentTreeNo . '=' . $gchild->memberid . '">';
                    echo '<img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/2.jpg" alt="">';
                    echo '<p>' . $gchild->memberid . '</p>';
                    echo '</a>';
                    echo '</td>';
                } else {
                    echo '<td>';
                    echo '<img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/0.jpg" alt="">';
                    echo '<p>Vacant</p>';
                    echo '</td>';
                }
            }
        } else {
            // Fill with 3 empty cells if no grandchildren
            for ($k = 0; $k < 3; $k++) {
                echo '<td>';
                echo '<img style="border-radius: 50%; max-width: 50%;" src="assets/images/team/0.jpg" alt="">';
                echo '<p>Vacant</p>';
                echo '</td>';
            }
        }
    }
    echo '</tr>';
}
@endphp
```

---

### **8. Navigation Features**

#### **8.1 Click-to-Navigate**
- **URL Pattern**: `?root_{tree_no}={memberid}`
- **Functionality**: Any node click sets that node as new root
- **Persistence**: URL-based navigation maintains state on refresh

#### **8.2 Tab Persistence**
```javascript
// Automatic tab state preservation
document.addEventListener('DOMContentLoaded', function() {
    let hash = window.location.hash;
    if (hash && hash.startsWith('#top-b')) {
        // Activate tab from URL hash
        let tabElement = document.getElementById(hash.substring(1));
        let tabTrigger = document.querySelector(`[data-bs-target="${hash}"]`);
        if (tabElement && tabTrigger) {
            // Remove active from all, activate selected
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('show', 'active');
            });
            tabTrigger.classList.add('active');
            tabElement.classList.add('show', 'active');
        }
    }
    
    // Update hash on tab click
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(function(tab) {
        tab.addEventListener('click', function(e) {
            let target = this.getAttribute('href');
            if (target) {
                history.replaceState(null, null, target);
            }
        });
    });
});
```

---

### **9. Styling & Responsive Design**

#### **9.1 Core CSS Classes**
```css
.vendor-table .table {
    width: 100%;
    table-layout: fixed;
    margin: 0 auto;
    border-collapse: separate;
    border-spacing: 10px;
}

.vendor-table .table td {
    text-align: center !important;
    vertical-align: middle !important;
    padding: 15px 10px;
    border: none;
}

.vendor-table .table td img {
    display: block;
    margin: 0 auto 8px auto;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.2s ease;
    border-radius: 50%;
    max-width: 50%;
}

.vendor-table .table td img:hover {
    transform: scale(1.1);
}

.vendor-table .table td a {
    text-decoration: none;
    color: #333;
    font-weight: 500;
    display: block;
}

.vendor-table .table td a:hover {
    color: #007bff;
}
```

#### **9.2 Responsive Adjustments**
```css
@media (max-width: 768px) {
    .vendor-table .table td img {
        max-width: 80%;
    }
    
    .vendor-table .table td {
        padding: 10px 5px;
    }
    
    .vendor-table .table {
        border-spacing: 5px;
    }
}
```

---

### **10. Routes Configuration**

```php
// In routes/web.php
Route::group(['middleware' => 'auth'], function () {
    Route::get('/team_per_tree', [reports_controller_admin::class, 'team_per_tree']);
    Route::get('/global_tree', [reports_controller_admin::class, 'global_tree']);
    Route::get('/fast_track_tree', [reports_controller_admin::class, 'fast_track_tree']);
    Route::get('/achievement_tree', [reports_controller_admin::class, 'achievement_tree']);
});
```

---

### **11. Implementation Steps**

#### **11.1 Database Setup**
1. Create tree tables for each tree type
2. Add indexes for performance
3. Create mlm_plan table for member references

#### **11.2 Controller Development**
1. Implement base controller methods
2. Add recursive tree builders
3. Implement level counting (if needed)
4. Add navigation parameter handling

#### **11.3 Frontend Development**
1. Create Blade templates
2. Implement tree rendering functions
3. Add Bootstrap tabs/accordion structure
4. Include responsive CSS

#### **11.4 JavaScript Enhancement**
1. Add tab persistence functionality
2. Implement click navigation
3. Add responsive behaviors

---

### **12. Performance Considerations**

#### **12.1 Database Optimization**
- Index on `(memberid, tree_no)` for root queries
- Index on `(placement_id, pos, tree_no)` for child queries
- Consider query caching for static trees

#### **12.2 Frontend Optimization**
- Lazy load tree data for inactive tabs
- Implement virtual scrolling for large trees
- Cache tree structures in localStorage

#### **12.3 Scalability**
- Implement pagination for deep trees
- Consider WebSocket updates for real-time changes
- Add API endpoints for AJAX tree loading

---

### **13. Extension Points**

#### **13.1 Additional Tree Types**
- Follow the same pattern for new tree types
- Adjust board counts and filling methods as needed
- Implement specific business logic in helper methods

#### **13.2 Enhanced Features**
- Search functionality within trees
- Export tree structures
- Tree comparison tools
- Member statistics overlay

#### **13.3 Integration Options**
- REST API for mobile apps
- WebSocket for real-time updates
- Export to various formats (PDF, Excel)

---

### **14. Testing Strategy**

#### **14.1 Unit Tests**
- Test recursive tree building functions
- Validate level counting algorithms
- Test navigation parameter handling

#### **14.2 Integration Tests**
- Test controller-view integration
- Validate database queries
- Test responsive design

#### **14.3 Performance Tests**
- Load testing with large tree structures
- Browser compatibility testing
- Mobile device testing

---

### **15. Documentation Requirements**

#### **15.1 Technical Documentation**
- API documentation for controller methods
- Database schema documentation
- Frontend component documentation

#### **15.2 User Documentation**
- Tree navigation guide
- Feature overview
- Troubleshooting guide

#### **15.3 Deployment Documentation**
- Installation instructions
- Configuration guide
- Maintenance procedures

---

This PRD provides a complete blueprint for implementing the Ternary Tree Display System in any Laravel-based MLM platform. The modular design allows for easy customization and extension based on specific business requirements.
