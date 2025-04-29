// Game variables
let score = 0; // Tracks the player's current score
let health = 5; // Tracks remaining health points (starts at 5)
let startTime = Date.now(); // Records when the game started for timer calculation
let planes = []; // Array to store all active plane objects in the game
let words = ['attack', 'defend', 'victory', 'battle', 'soldier', 'missile', 
            'fighter', 'bomber', 'target', 'shield', 'weapon', 'strategy',
            'command', 'victory', 'danger', 'enemy', 'defense', 'offense', 
            "pizza", "burger", "sushi", "pasta", "salad", "apple", "banana", 
            "orange", "grape", "melon", "bread", "cheese", "coffee", "steak",
            "soup", "keyboard", "mouse", "monitor", "laptop", "code",
            "server", "python", "javascript", "html", "css","algorithm",
            "soldier", "battle", "army", "general", "strategy",
            "victory", "defeat", "weapon", "tank", "sniper",
            "student", "professor", "campus", "library", "lecture",
            "research", "degree", "science", "math", "history",
            "database", "network", "software", "hardware"]; // Dictionary of possible words displayed on planes
let currentInput = ''; // Stores the player's current text input
let activePlane = null; // References the currently targeted plane (if any)

// DOM element references
const gameContainer = document.getElementById('game-container'); // Main game area
const wordInput = document.getElementById('word-input'); // Text input field
const scoreDisplay = document.getElementById('score'); // Score display element
const timeDisplay = document.getElementById('time'); // Timer display element
const currentTargetDisplay = document.getElementById('current-target'); // Shows current input
const cannon = document.getElementById('cannon'); // Cannon element reference
const fort = document.getElementById('fort'); // Player's fort/base element
const healthPoints = document.querySelectorAll('.health-point'); // Health indicator elements

/**
 * Initializes the game by setting up intervals and event listeners
 */
function init() {
    // Create new planes at regular intervals (every 1.5 seconds)
    setInterval(createPlane, 1500);
    
    // Update the game timer every second
    setInterval(updateTimer, 1000);
    
    // Set up input handler for the word input field
    wordInput.addEventListener('input', handleInput);
    wordInput.focus(); // Automatically focus the input field
}

/**
 * Creates a new enemy plane and adds it to the game
 */
function createPlane() {
    // Limit the number of planes on screen to 5
    if (planes.length > 5) return;
    
    // Create plane container element
    const plane = document.createElement('div');
    plane.className = 'plane';
    
    // Create and append plane image
    const img = document.createElement('img');
    img.src = 'Photos/F15.png'; // Path to plane image
    img.alt = 'plane';
    plane.appendChild(img);
    
    // Select a random word from the dictionary
    const word = words[Math.floor(Math.random() * words.length)];
    const wordElement = document.createElement('div');
    wordElement.className = 'plane-word';
    wordElement.textContent = word;
    plane.appendChild(wordElement);
    
    // Store the word as a data attribute
    plane.dataset.word = word;
    
    // Position the plane randomly at the top of the screen
    const left = Math.random() * (window.innerWidth - 100);
    plane.style.left = `${left}px`;
    plane.style.top = '-50px';
    
    // Add the plane to the game container
    gameContainer.appendChild(plane);
    
    // Set random movement speed for the plane
    const speed = Math.random() * 1;
    
    // Create plane object with all relevant properties
    const planeObj = { 
        element: plane,  // DOM element
        word: word,     // Assigned word
        speed: speed,   // Movement speed
        x: left,        // X position
        y: 100,         // Y position
        width: 80,      // Approximate width
        height: 30      // Approximate height
    };
    
    // Add to planes array
    planes.push(planeObj);
    
    // Set timeout to remove plane if it isn't shot down
    setTimeout(() => {
        if (plane.parentNode && !plane.dataset.hit) {
            plane.remove();
            planes = planes.filter(p => p.element !== plane);
        }
    }, 20000); // Remove after 20 seconds if still alive
}

/**
 * Handles player input and checks for matching plane words
 * @param {Event} e - The input event
 */
function handleInput(e) {
    // Get and store current input (in lowercase)
    currentInput = e.target.value.toLowerCase();
    currentTargetDisplay.textContent = currentInput;
    
    // Check if input matches any plane's word
    for (const plane of planes) {
        if (plane.word.toLowerCase() === currentInput) {
            activePlane = plane;
            shootPlane(plane); // Shoot at matching plane
            break;
        }
    }
}

/**
 * Creates and animates a bullet toward the specified plane
 * @param {Object} plane - The plane object to shoot at
 */
function shootPlane(plane) {
    // Create bullet element
    const bullet = document.createElement('div');
    bullet.className = 'bullet';
    bullet.style.left = `${window.innerWidth / 2 - 2}px`;
    bullet.style.bottom = `${fort.offsetHeight + 10}px`;
    gameContainer.appendChild(bullet);
    
    // Calculate target position (center of plane)
    const planeRect = plane.element.getBoundingClientRect();
    const targetX = planeRect.left + planeRect.width / 2;
    const targetY = planeRect.top + planeRect.height / 2;
    
    // Calculate starting position (from cannon)
    const startX = window.innerWidth / 2;
    const startY = window.innerHeight - fort.offsetHeight;
    
    // Calculate distance to target
    const distance = Math.sqrt(Math.pow(targetX - startX, 2) + Math.pow(targetY - startY, 2));
    const duration = distance / 800; // pixels per millisecond
    
    const animationStart = Date.now();
    
    /**
     * Animates the bullet toward the target plane
     */
    function animateBullet() {
        const elapsed = Date.now() - animationStart;
        const progress = Math.min(elapsed / (duration * 1000), 1);
        
        if (progress < 1) {
            // Calculate current position based on animation progress
            const currentX = startX + (targetX - startX) * progress;
            const currentY = startY + (targetY - startY) * progress;
            
            // Update bullet position
            bullet.style.left = `${currentX}px`;
            bullet.style.top = `${currentY}px`;
            
            // Continue animation
            requestAnimationFrame(animateBullet);
        } else {
            // Animation complete - remove bullet and destroy plane
            bullet.remove();
            destroyPlane(plane);
        }
    }
    
    // Start animation
    animateBullet();
}

/**
 * Destroys a plane and updates game state
 * @param {Object} plane - The plane to destroy
 */
function destroyPlane(plane) {
    // Mark plane as hit
    plane.element.dataset.hit = 'true';
    
    // Create explosion effect
    const explosion = document.createElement('div');
    explosion.className = 'explosion';
    explosion.style.left = `${plane.x + plane.width/2 - 20}px`;
    explosion.style.top = `${plane.y + plane.height/2 - 20}px`;
    gameContainer.appendChild(explosion);
    
    // Remove explosion after animation
    setTimeout(() => {
        explosion.remove();
    }, 500);
    
    // Remove plane from DOM and array
    plane.element.remove();
    planes = planes.filter(p => p !== plane);
    
    // Update score
    score++;
    scoreDisplay.textContent = score;
    
    // Reset input
    wordInput.value = '';
    currentInput = '';
    currentTargetDisplay.textContent = '';
}

/**
 * Updates the game timer display
 */
function updateTimer() {
    const elapsed = Math.floor((Date.now() - startTime) / 1000);
    timeDisplay.textContent = elapsed;
}

/**
 * Updates the health display and checks for game over
 */
function updateHealth() {
    // Update each health point indicator
    healthPoints.forEach((point, index) => {
        if (index < health) {
            point.classList.add('filled');
        } else {
            point.classList.remove('filled');
        }
    });
    
    // Check for game over
    if (health <= 0) {
        alert(`Game Over! Your score: ${score}`);
        document.location.reload(); // Restart game
    }
}

/**
 * Checks if any planes have reached the fort (collision detection)
 */
function checkCollisions() {
    const fortTop = window.innerHeight - fort.offsetHeight;
    
    for (const plane of planes) {
        const planeBottom = plane.y + plane.height;
        
        // Check if plane has reached the fort
        if (planeBottom >= fortTop) {
            // Remove plane
            plane.element.remove();
            planes = planes.filter(p => p !== plane);
            
            // Decrease health
            health--;
            updateHealth();
            
            // Show damage effect at impact point
            const damageEffect = document.createElement('div');
            damageEffect.className = 'explosion';
            damageEffect.style.left = `${plane.x + plane.width/2 - 20}px`;
            damageEffect.style.top = `${fortTop - 20}px`;
            gameContainer.appendChild(damageEffect);
            
            // Remove damage effect after animation
            setTimeout(() => {
                damageEffect.remove();
            }, 500);
        }
    }
}

/**
 * Updates all plane positions and checks for collisions
 * Runs in a continuous loop using requestAnimationFrame
 */
function updatePlanes() {
    // Move each plane downward
    for (const plane of planes) {
        plane.y += plane.speed;
        plane.element.style.top = `${plane.y}px`;
    }
    
    // Check for collisions with fort
    checkCollisions();
    
    // Continue animation loop
    requestAnimationFrame(updatePlanes);
}

// Start the game
init(); // Initialize game systems
updatePlanes(); // Start plane movement loop