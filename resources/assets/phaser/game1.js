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

// On every frame update
function update() {
    this.xVelocity = (this.xVelocity + (Math.random() * 50 - 25)) % 200;
    this.yVelocity = (this.yVelocity + (Math.random() * 50 - 25)) % 200;

    this.logo.setVelocity(this.xVelocity, this.yVelocity);
}

function preload() {
    this.load.setBaseURL('images');
    this.load.image('logo', 'owl_standalone.png');
    this.load.image('sky', 'sky.jpg');
}

function create() {
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
