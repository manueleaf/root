class Sprite {
    constructor({
        position, 
        image, 
        frames = { max: 1, hold: 7 }, 
        sprites, 
        ani = false, 
        rotation=0
    }) {
        this.position = position
        this.image = new Image()
        this.frames = { ...frames, val: 0, elapsed: 0 }

        this.image.onload = () => {
            this.width = this.image.width / this.frames.max
            this.height = this.image.height
        }
        this.image.src = image.src
        this.moving = ani
        this.sprites = sprites
        this.opacity = 1
        this.rotation = rotation
    }
    draw() {
        c.save()
        c.translate(this.position.x + this.width /2 ,this.position.y + this.height/2)
        c.rotate(this.rotation)
        c.translate(-this.position.x - this.width/2,-this.position.y - this.height/2)
        c.globalAlpha = this.opacity
        c.drawImage(
            this.image,
            this.frames.val * this.width,
            0, this.image.width / this.frames.max, this.image.height,
            this.position.x,
            this.position.y,
            this.image.width / this.frames.max,
            this.image.height)
        c.restore()


        if (!this.moving) return
        if (this.frames.max > 1) {
            this.frames.elapsed++
        }
        if (this.frames.elapsed % this.frames.hold === 0) {
            if (this.frames.val < this.frames.max - 1) this.frames.val++
            else this.frames.val = 0
        }
    }

}

class Monster extends Sprite {
    constructor({
        position, image, frames = { max: 1, hold: 7 }, sprites, ani = false, rotation=0, isEnemy = false, name= 'missingNo.', attacks
    }) {
        super({
            position, image, frames , sprites, ani, rotation
        })
        this.health = 100
        this.isEnemy = isEnemy
        this.name=name,
        this.attacks = attacks
    }

    faint(){
        let fainted= 'Has caido!'
        if (this.isEnemy) fainted = this.name + ' ha caido!'
        document.querySelector('#dialogos').innerHTML = fainted
        gsap.to(this.position,{
            y: this.position.y +20
        })
        gsap.to(this, {
            opacity: 0
        })
    }

    attack({ attack, recipient, renderedSprites }) {
        document.querySelector('#dialogos').style.display = 'block'
        let texto= ' uso '
        if (this.isEnemy) texto = ' enemigo uso '
        document.querySelector('#dialogos').innerHTML = this.name + texto + attack.name + '!'
        let healthbar = '#enemyHealth'
        if (this.isEnemy) healthbar = '#playerHealth'

        let rotation= 0.75
        if (this.isEnemy) rotation = -2.75

        recipient.health -= attack.damage
        switch (attack.name) {
            case 'Placaje':
                const tl = gsap.timeline()

                let movementDistance = 20
                if (this.isEnemy) movementDistance = -20

                tl.to(this.position, {
                    x: this.position.x - movementDistance
                })
                    .to(this.position, {
                        x: this.position.x + movementDistance * 2, duration: .2,
                        onComplete: () => {
                            gsap.to(healthbar, {
                                width: recipient.health + '%'
                            })

                            gsap.to(recipient.position, {
                                x: recipient.position.x + 10, yoyo: true, repeat: 5, duration: 0.07
                            })
                            gsap.to(recipient, { opacity: 0.2, repeat: 5, yoyo: true, duration: 0.07 })
                        }
                    })
                    .to(this.position, {
                        x: this.position.x
                    })

                    break;

            case 'Fuego':
                const fireImage = new Image()
                fireImage.src = './img/fireball.png'
                const fire = new Sprite({
                    position: {
                        x: this.position.x,
                        y: this.position.y
                    },
                    image: fireImage,
                    frames: {
                        max: 4,
                        hold: 10
                    },
                    ani: true,
                    rotation: rotation
                })
                renderedSprites.splice(1, 0, fire)

                gsap.to(fire.position, {
                    x: recipient.position.x,
                    y: recipient.position.y,
                    duration: 0.9,
                    onComplete: () => {
                        renderedSprites.splice(1,1)

                        // Enemy actually gets hit
                        gsap.to(healthbar, {
                            width: recipient.health + '%'
                        })

                        gsap.to(recipient.position, {
                            x: recipient.position.x + 10,
                            yoyo: true,
                            repeat: 5,
                            duration: 0.08
                        })

                        gsap.to(recipient, {
                            opacity: 0,
                            repeat: 5,
                            yoyo: true,
                            duration: 0.08
                        })
                    }
                })
                    break;

                case 'Congelar':
                    const iceImage = new Image()
                    iceImage.src = './img/ice.png'
                    const ice = new Sprite({
                        position: {
                            x: recipient.position.x,
                            y: recipient.position.y
                        },
                        image: iceImage,
                        frames: {
                            max: 9,
                            hold: 12
                        },
                        ani: true,
                        rotation: rotation
                    })
                    renderedSprites.splice(2, 0, ice)
    
                    gsap.to(ice.position, {
                        x: recipient.position.x,
                        y: recipient.position.y,
                        duration: 2,
                        onComplete: () => {
                            renderedSprites.splice(2,1)
    
                            // Enemy actually gets hit
                            gsap.to(healthbar, {
                                width: recipient.health + '%'
                            })
    
                            gsap.to(recipient.position, {
                                x: recipient.position.x + 10,
                                yoyo: true,
                                repeat: 5,
                                duration: 0.08
                            })
    
                            gsap.to(recipient, {
                                opacity: 0,
                                repeat: 5,
                                yoyo: true,
                                duration: 0.08
                            })
                        }
                    })

                    break;

        }

}}

class Borde {
    static width = 48
    static height = 48
    constructor({ position }) {
        this.position = position
        this.width = 48
        this.height = 48
    }
    draw() {
        c.fillStyle = 'red'
        c.fillRect(this.position.x, this.position.y, this.width, this.height)
    }
}