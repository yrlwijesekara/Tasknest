document.addEventListener('DOMContentLoaded', function() {
    const taskForm = document.getElementById('taskForm');
    const taskList = document.getElementById('taskList');
    const taskTitle = document.getElementById('taskTitle');
    const taskDescription = document.getElementById('taskDescription');
    
    // Array to store tasks
    let tasks = [];
    
    // Load tasks from localStorage if available
    loadTasks();
    
    // Form submission handler
    taskForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const title = taskTitle.value.trim();
        const description = taskDescription.value.trim();
        
        if (title && description) {
            addTask(title, description);
            taskForm.reset();
        }
    });
    
    // Function to add a new task
    function addTask(title, description) {
        const task = {
            id: Date.now(),
            title: title,
            description: description,
            createdAt: new Date().toLocaleString()
        };
        
        tasks.push(task);
        saveTasks();
        renderTasks();
    }
    
    // Function to delete a task
    function deleteTask(id) {
        tasks = tasks.filter(task => task.id !== id);
        saveTasks();
        renderTasks();
    }
    
    // Function to render all tasks
    function renderTasks() {
        taskList.innerHTML = '';
        
        if (tasks.length === 0) {
            taskList.innerHTML = '<div class="empty-state">No tasks yet. Add your first task!</div>';
            return;
        }
        
        tasks.forEach(task => {
            const taskElement = createTaskElement(task);
            taskList.appendChild(taskElement);
        });
    }
    
    // Function to create a task element
    function createTaskElement(task) {
        const taskDiv = document.createElement('div');
        taskDiv.className = 'task-item';
        taskDiv.innerHTML = `
            <button class="done-btn" onclick="deleteTask(${task.id})" title="Mark as done">Done</button>
            <div class="task-title">${escapeHtml(task.title)}</div>
            <div class="task-description">${escapeHtml(task.description)}</div>
            <div class="task-date">Created: ${task.createdAt}</div>
        `;
        
        return taskDiv;
    }
    
    // Function to escape HTML to prevent XSS
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    // Function to save tasks to localStorage
    function saveTasks() {
        localStorage.setItem('taskNestTasks', JSON.stringify(tasks));
    }
    
    // Function to load tasks from localStorage
    function loadTasks() {
        const savedTasks = localStorage.getItem('taskNestTasks');
        if (savedTasks) {
            tasks = JSON.parse(savedTasks);
            renderTasks();
        } else {
            renderTasks();
        }
    }
    
    // Make deleteTask function global so it can be called from onclick
    window.deleteTask = deleteTask;
});

