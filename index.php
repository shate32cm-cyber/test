<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>智能任务管理平台</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', 'Microsoft YaHei', sans-serif;
        }

        :root {
            --bg-primary: #1a1a1a;
            --bg-secondary: #2d2d2d;
            --bg-tertiary: #3d3d3d;
            --bg-sidebar: #252525;
            --text-primary: #ffffff;
            --text-secondary: #cccccc;
            --text-muted: #888888;
            --accent-blue: #3b82f6;
            --accent-green: #10b981;
            --accent-purple: #8b5cf6;
            --accent-red: #ef4444;
            --border-color: #444444;
            --hover-color: #363636;
            --radius-sm: 6px;
            --radius-md: 10px;
            --radius-lg: 14px;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.2);
            --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.3);
            --shadow-lg: 0 8px 16px rgba(0, 0, 0, 0.4);
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* 侧边栏样式 */
        .sidebar {
            width: 280px;
            background-color: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            transition: transform 0.3s ease;
            z-index: 100;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
        }

        .app-name {
            font-size: 20px;
            font-weight: 700;
            background: linear-gradient(to right, var(--accent-blue), var(--accent-purple));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .sidebar-nav {
            padding: 16px;
            flex-grow: 1;
            overflow-y: auto;
        }

        .nav-item {
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: background-color 0.2s;
            color: var(--text-secondary);
        }

        .nav-item:hover {
            background-color: var(--hover-color);
        }

        .nav-item.active {
            background-color: var(--bg-tertiary);
            color: var(--text-primary);
        }

        .nav-icon {
            width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-green), var(--accent-blue));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .user-info {
            flex-grow: 1;
        }

        .user-name {
            font-weight: 600;
        }

        .user-role {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* 主内容区域 */
        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .top-bar {
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-color);
            flex-shrink: 0;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .breadcrumb-item {
            color: var(--text-muted);
        }

        .breadcrumb-separator {
            color: var(--text-muted);
        }

        .breadcrumb-item.active {
            color: var(--text-primary);
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: var(--radius-sm);
            border: none;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 14px;
        }

        .btn-primary {
            background-color: var(--accent-blue);
            color: white;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }

        .btn-secondary {
            background-color: var(--bg-tertiary);
            color: var(--text-primary);
        }

        .btn-secondary:hover {
            background-color: var(--hover-color);
        }

        .search-bar {
            position: relative;
        }

        .search-input {
            padding: 8px 12px 8px 36px;
            background-color: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            color: var(--text-primary);
            font-size: 14px;
            width: 200px;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        /* 内容区域 */
        .content-area {
            flex-grow: 1;
            padding: 24px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
        }

        .page-actions {
            display: flex;
            gap: 12px;
        }

        .view-toggle {
            display: flex;
            background-color: var(--bg-secondary);
            border-radius: var(--radius-sm);
            padding: 4px;
        }

        .view-btn {
            padding: 6px 12px;
            border-radius: 4px;
            border: none;
            background: transparent;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 14px;
        }

        .view-btn.active {
            background-color: var(--bg-tertiary);
            color: var(--text-primary);
        }

        /* 任务卡片 */
        .tasks-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        @media (max-width: 1024px) {
            .tasks-container {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .tasks-container {
                grid-template-columns: 1fr;
            }
        }

        .task-card {
            background-color: var(--bg-secondary);
            border-radius: var(--radius-md);
            padding: 20px;
            border: 1px solid var(--border-color);
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: move;
        }

        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .task-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .task-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .task-description {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.5;
            margin-bottom: 16px;
        }

        .task-properties {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 16px;
        }

        .property {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--text-muted);
            background-color: var(--bg-tertiary);
            padding: 4px 8px;
            border-radius: 4px;
        }

        .property-icon {
            font-size: 10px;
        }

        .task-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 12px;
            border-top: 1px solid var(--border-color);
        }

        .task-actions {
            display: flex;
            gap: 8px;
        }

        .task-action-btn {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: none;
            background-color: var(--bg-tertiary);
            color: var(--text-secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s;
        }

        .task-action-btn:hover {
            background-color: var(--hover-color);
            color: var(--text-primary);
        }

        .task-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-todo {
            background-color: rgba(239, 68, 68, 0.2);
            color: var(--accent-red);
        }

        .status-in-progress {
            background-color: rgba(59, 130, 246, 0.2);
            color: var(--accent-blue);
        }

        .status-done {
            background-color: rgba(16, 185, 129, 0.2);
            color: var(--accent-green);
        }

        /* 添加任务卡片 */
        .add-task-card {
            background-color: var(--bg-secondary);
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-md);
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: border-color 0.2s;
            min-height: 180px;
        }

        .add-task-card:hover {
            border-color: var(--accent-blue);
        }

        .add-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--bg-tertiary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            color: var(--accent-blue);
            font-size: 20px;
        }

        .add-text {
            color: var(--text-muted);
            font-size: 14px;
        }

        /* 移动端适配 */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 20px;
            cursor: pointer;
            padding: 8px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .mobile-menu-btn {
                display: block;
            }

            .search-input {
                width: 150px;
            }

            .top-actions {
                gap: 8px;
            }

            .btn {
                padding: 6px 12px;
                font-size: 13px;
            }

            .page-title {
                font-size: 22px;
            }

            .content-area {
                padding: 16px;
            }
        }

        /* 遮罩层 */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 50;
        }

        .overlay.active {
            display: block;
        }

        /* 状态标签 */
        .status-filter {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .status-filter-btn {
            padding: 6px 12px;
            border-radius: 20px;
            border: 1px solid var(--border-color);
            background-color: var(--bg-secondary);
            color: var(--text-secondary);
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .status-filter-btn.active {
            background-color: var(--accent-blue);
            border-color: var(--accent-blue);
            color: white;
        }

        /* 动画效果 */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .task-card {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
</head>
<body>
    <!-- 移动端遮罩层 -->
    <div class="overlay" id="overlay"></div>

    <!-- 侧边栏 -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">KG</div>
            <div class="app-name">任务管理</div>
        </div>
        
        <div class="sidebar-nav">
            <div class="nav-item active">
                <div class="nav-icon"><i class="fas fa-tasks"></i></div>
                <div>所有任务</div>
            </div>
            <div class="nav-item">
                <div class="nav-icon"><i class="fas fa-calendar-alt"></i></div>
                <div>日历视图</div>
            </div>
            <div class="nav-item">
                <div class="nav-icon"><i class="fas fa-chart-bar"></i></div>
                <div>数据统计</div>
            </div>
            <div class="nav-item">
                <div class="nav-icon"><i class="fas fa-tags"></i></div>
                <div>标签管理</div>
            </div>
            <div class="nav-item">
                <div class="nav-icon"><i class="fas fa-users"></i></div>
                <div>团队协作</div>
            </div>
            <div class="nav-item">
                <div class="nav-icon"><i class="fas fa-cog"></i></div>
                <div>系统设置</div>
            </div>  <div class="nav-item">
                <div class="nav-icon"><i class="fas fa-cog"></i></div>
                <div>系统设置</div>
            </div>  <div class="nav-item">
                <div class="nav-icon"><i class="fas fa-cog"></i></div>
                <div>系统设置</div>
            </div>
        </div>
        
        <div class="sidebar-footer">
            <div class="user-avatar">KG</div>
            <div class="user-info">
                <div class="user-name">株式会社 KG.ONE</div>
                <div class="user-role">管理员</div>
            </div>
            <div>
                <button class="task-action-btn"><i class="fas fa-sign-out-alt"></i></button>
            </div>
        </div>
    </div>

    <!-- 主内容区域 -->
    <div class="main-content">
        <!-- 顶部导航栏 -->
        <div class="top-bar">
            <div class="breadcrumb">
                <button class="mobile-menu-btn" id="menuBtn">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="breadcrumb-item">任务管理</div>
                <div class="breadcrumb-separator">/</div>
                <div class="breadcrumb-item active">所有任务</div>
            </div>
            
            <div class="top-actions">
                <div class="search-bar">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="搜索任务...">
                </div>
                <button class="btn btn-secondary">
                    <i class="fas fa-filter"></i> 筛选
                </button>
                <button class="btn btn-primary" id="addTaskBtn">
                    <i class="fas fa-plus"></i> 新建任务
                </button>
            </div>
        </div>

        <!-- 内容区域 -->
        <div class="content-area">
            <div class="page-header">
                <div class="page-title">任务看板</div>
                <div class="page-actions">
                    <div class="view-toggle">
                        <button class="view-btn active"><i class="fas fa-th-large"></i> 卡片</button>
                        <button class="view-btn"><i class="fas fa-list"></i> 列表</button>
                        <button class="view-btn"><i class="fas fa-chart-pie"></i> 图表</button>
                    </div>
                </div>
            </div>

            <!-- 状态筛选 -->
            <div class="status-filter">
                <button class="status-filter-btn active">全部任务</button>
                <button class="status-filter-btn">待处理</button>
                <button class="status-filter-btn">进行中</button>
                <button class="status-filter-btn">已完成</button>
                <button class="status-filter-btn">已延期</button>
            </div>

            <!-- 任务卡片区域 -->
            <div class="tasks-container">
                <!-- 任务卡片1 -->
                <div class="task-card" draggable="true">
                    <div class="task-header">
                        <div>
                            <div class="task-title">化妆品采购清单整理</div>
                        </div>
                        <div class="task-actions">
                            <button class="task-action-btn"><i class="fas fa-edit"></i></button>
                            <button class="task-action-btn"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="task-description">
                        整理2024年春季化妆品采购清单，包括SK-II、资生堂等品牌的新品。
                    </div>
                    <div class="task-properties">
                        <div class="property">
                            <i class="far fa-calendar property-icon"></i>
                            <span>2024-03-15</span>
                        </div>
                        <div class="property">
                            <i class="fas fa-user property-icon"></i>
                            <span>桥本贸易</span>
                        </div>
                        <div class="property">
                            <i class="fas fa-tag property-icon"></i>
                            <span>采购</span>
                        </div>
                    </div>
                    <div class="task-footer">
                        <div class="task-status status-in-progress">进行中</div>
                        <div class="task-actions">
                            <button class="task-action-btn"><i class="fas fa-paperclip"></i></button>
                            <button class="task-action-btn"><i class="fas fa-comment"></i></button>
                        </div>
                    </div>
                </div>

                <!-- 任务卡片2 -->
                <div class="task-card" draggable="true">
                    <div class="task-header">
                        <div>
                            <div class="task-title">健康食品市场调研报告</div>
                        </div>
                        <div class="task-actions">
                            <button class="task-action-btn"><i class="fas fa-edit"></i></button>
                            <button class="task-action-btn"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="task-description">
                        完成对日本健康食品市场的调研，重点分析大木制药和ナチュラルショップ的产品线。
                    </div>
                    <div class="task-properties">
                        <div class="property">
                            <i class="far fa-calendar property-icon"></i>
                            <span>2024-03-20</span>
                        </div>
                        <div class="property">
                            <i class="fas fa-user property-icon"></i>
                            <span>亜神株式会社</span>
                        </div>
                        <div class="property">
                            <i class="fas fa-tag property-icon"></i>
                            <span>调研</span>
                        </div>
                    </div>
                    <div class="task-footer">
                        <div class="task-status status-todo">待处理</div>
                        <div class="task-actions">
                            <button class="task-action-btn"><i class="fas fa-paperclip"></i></button>
                            <button class="task-action-btn"><i class="fas fa-comment"></i></button>
                        </div>
                    </div>
                </div>

                <!-- 任务卡片3 -->
                <div class="task-card" draggable="true">
                    <div class="task-header">
                        <div>
                            <div class="task-title">POS系统升级项目</div>
                        </div>
                        <div class="task-actions">
                            <button class="task-action-btn"><i class="fas fa-edit"></i></button>
                            <button class="task-action-btn"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="task-description">
                        与スマレジ和株式会社イオシステムズ对接，完成POS系统的升级和测试。
                    </div>
                    <div class="task-properties">
                        <div class="property">
                            <i class="far fa-calendar property-icon"></i>
                            <span>2024-03-25</span>
                        </div>
                        <div class="property">
                            <i class="fas fa-user property-icon"></i>
                            <span>大一株式会社</span>
                        </div>
                        <div class="property">
                            <i class="fas fa-tag property-icon"></i>
                            <span>技术</span>
                        </div>
                    </div>
                    <div class="task-footer">
                        <div class="task-status status-in-progress">进行中</div>
                        <div class="task-actions">
                            <button class="task-action-btn"><i class="fas fa-paperclip"></i></button>
                            <button class="task-action-btn"><i class="fas fa-comment"></i></button>
                        </div>
                    </div>
                </div>

                <!-- 任务卡片4 -->
                <div class="task-card" draggable="true">
                    <div class="task-header">
                        <div>
                            <div class="task-title">新春促销活动策划</div>
                        </div>
                        <div class="task-actions">
                            <button class="task-action-btn"><i class="fas fa-edit"></i></button>
                            <button class="task-action-btn"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="task-description">
                        与ALIDADA株式会社合作，策划2024年新春促销活动，重点推广化妆品和健康食品。
                    </div>
                    <div class="task-properties">
                        <div class="property">
                            <i class="far fa-calendar property-icon"></i>
                            <span>2024-03-10</span>
                        </div>
                        <div class="property">
                            <i class="fas fa-user property-icon"></i>
                            <span>富森商事</span>
                        </div>
                        <div class="property">
                            <i class="fas fa-tag property-icon"></i>
                            <span>营销</span>
                        </div>
                    </div>
                    <div class="task-footer">
                        <div class="task-status status-done">已完成</div>
                        <div class="task-actions">
                            <button class="task-action-btn"><i class="fas fa-paperclip"></i></button>
                            <button class="task-action-btn"><i class="fas fa-comment"></i></button>
                        </div>
                    </div>
                </div>

                <!-- 添加任务卡片 -->
                <div class="add-task-card" id="addCard">
                    <div class="add-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="add-text">点击添加新任务</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // 移动端菜单切换
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        // 添加任务按钮
        const addTaskBtn = document.getElementById('addTaskBtn');
        const addCard = document.getElementById('addCard');

        addTaskBtn.addEventListener('click', addNewTask);
        addCard.addEventListener('click', addNewTask);

        function addNewTask() {
            // 创建新任务卡片
            const taskContainer = document.querySelector('.tasks-container');
            const newTask = document.createElement('div');
            newTask.className = 'task-card';
            newTask.draggable = true;
            newTask.innerHTML = `
                <div class="task-header">
                    <div>
                        <div class="task-title" contenteditable="true">新建任务</div>
                    </div>
                    <div class="task-actions">
                        <button class="task-action-btn"><i class="fas fa-edit"></i></button>
                        <button class="task-action-btn delete-btn"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
                <div class="task-description" contenteditable="true">
                    点击此处添加任务描述...
                </div>
                <div class="task-properties">
                    <div class="property">
                        <i class="far fa-calendar property-icon"></i>
                        <span>${new Date().toISOString().slice(0, 10)}</span>
                    </div>
                    <div class="property">
                        <i class="fas fa-user property-icon"></i>
                        <span>未分配</span>
                    </div>
                    <div class="property">
                        <i class="fas fa-tag property-icon"></i>
                        <span>常规</span>
                    </div>
                </div>
                <div class="task-footer">
                    <div class="task-status status-todo">待处理</div>
                    <div class="task-actions">
                        <button class="task-action-btn"><i class="fas fa-paperclip"></i></button>
                        <button class="task-action-btn"><i class="fas fa-comment"></i></button>
                    </div>
                </div>
            `;

            // 在添加按钮前插入新任务
            taskContainer.insertBefore(newTask, addCard);
            
            // 添加删除功能
            const deleteBtn = newTask.querySelector('.delete-btn');
            deleteBtn.addEventListener('click', function() {
                taskContainer.removeChild(newTask);
            });

            // 添加拖拽功能
            addDragAndDrop(newTask);
            
            // 自动聚焦到标题
            setTimeout(() => {
                newTask.querySelector('.task-title').focus();
            }, 10);
        }

        // 状态筛选按钮
        const statusFilterBtns = document.querySelectorAll('.status-filter-btn');
        statusFilterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                statusFilterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // 这里可以添加筛选逻辑
                const status = this.textContent;
                console.log(`筛选状态: ${status}`);
            });
        });

        // 视图切换按钮
        const viewBtns = document.querySelectorAll('.view-btn');
        viewBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                viewBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // 这里可以添加视图切换逻辑
                const view = this.textContent;
                console.log(`切换到: ${view} 视图`);
            });
        });

        // 拖拽功能
        function addDragAndDrop(element) {
            element.addEventListener('dragstart', function(e) {
                e.dataTransfer.setData('text/plain', e.target.className);
                setTimeout(() => {
                    this.style.opacity = '0.4';
                }, 0);
            });

            element.addEventListener('dragend', function(e) {
                this.style.opacity = '1';
            });
        }

        // 为所有任务卡片添加拖拽功能
        document.querySelectorAll('.task-card').forEach(addDragAndDrop);

        // 允许放置拖拽元素
        document.addEventListener('dragover', function(e) {
            e.preventDefault();
        });

        document.addEventListener('drop', function(e) {
            e.preventDefault();
            const taskContainer = document.querySelector('.tasks-container');
            
            // 简单的重新排序逻辑（实际应用中需要更复杂的逻辑）
            if (e.target.closest('.task-card') || e.target.closest('.add-task-card')) {
                console.log('任务位置已更新');
            }
        });

        // 搜索功能
        const searchInput = document.querySelector('.search-input');
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const taskCards = document.querySelectorAll('.task-card');
            
            taskCards.forEach(card => {
                const title = card.querySelector('.task-title').textContent.toLowerCase();
                const description = card.querySelector('.task-description').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // 导航项点击
        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            item.addEventListener('click', function() {
                navItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
                
                // 在移动端点击后关闭菜单
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            });
        });

        // 窗口大小变化时调整布局
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
    </script>
</body>
</html>