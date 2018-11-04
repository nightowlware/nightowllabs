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
        create: create
    }
};

const game = new Phaser.Game(config);

function preload ()
{
    this.load.setBaseURL('images');

    this.load.image('logo', 'owl_standalone.png');
    this.load.image('sky', 'sky.jpg');
}

function create ()
{
    this.add.image(400, 300, 'sky');

    var particles = this.add.particles('logo');

    var emitter = particles.createEmitter({
        speed: 200,
        scale: { start: 0.5, end: 0 },
        blendMode: 'NORMAL'
    });

    var logo = this.physics.add.image(400, 100, 'logo');

    logo.setVelocity(30, 40);
    logo.setBounce(1, 1);
    logo.setCollideWorldBounds(true);

    emitter.startFollow(logo);
}
