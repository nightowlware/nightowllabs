const config = {
    type: Phaser.WEBGL,
    width: 800,
    height: 600,
    parent: 'game',
    physics: {
        default: 'arcade',
        arcade: {
            gravity: { y: 500 }
        }
    },
    scene: {
        preload: preload,
        create: create,
        update: update
    }
};

const game = new Phaser.Game(config);

// On every frame update.
function update() {
    const delta = 20;
    const cap = 200;
    this.xVelocity = (this.xVelocity + (Math.random() * delta - delta/2)) % cap;
    this.yVelocity = (this.yVelocity + (Math.random() * delta - delta/2)) % cap;

    if (this.cursorKeys.left.isDown) {
        this.xVelocity -= 50;
    }

    if (this.cursorKeys.right.isDown) {
        this.xVelocity += 50;
    }

    if (this.cursorKeys.up.isDown) {
        this.yVelocity -= 50;
    }

    if (this.cursorKeys.down.isDown) {
        this.yVelocity += 50;
    }

    this.logo.setVelocity(this.xVelocity, this.yVelocity);
}

function preload() {
    this.load.setBaseURL('images');
    this.load.image('logo', 'owl_standalone.png');
    this.load.image('sky', 'sky.jpg');
}

// Sets up the initial game state.
function create() {
    this.input.keyboard.on('keydown_A', () => {
        this.xVelocity -= 40;
        console.log(this.xVelocity);
    });

    // for some reason, cursor (arrow keys) don't support callbacks like above.
    this.cursorKeys = this.input.keyboard.createCursorKeys();

    this.add.image(400, 300, 'sky');

    let particles = this.add.particles('logo');

    let emitter = particles.createEmitter({
        speed: 200,
        scale: { start: 0.5, end: 0 },
        blendMode: 'NORMAL'
    });

    this.logo = this.physics.add.image(400, 100, 'logo');
    this.logo.setBounce(1, 1);
    this.logo.setCollideWorldBounds(true);

    this.xVelocity = 0;
    this.yVelocity = 0;

    emitter.startFollow(this.logo);
}
