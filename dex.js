const canvas = document.querySelector('canvas');
const c = canvas.getContext('2d')

canvas.width = 1024
canvas.height = 576

const collisionsMap = []
for (let i = 0; i < collisions.length; i += 70) {
    collisionsMap.push(collisions.slice(i, 70 + i))
}

const collisionsPasto1 = []
for (let i = 0; i < pasto1Dato.length; i += 70) {
    collisionsPasto1.push(pasto1Dato.slice(i, 70 + i))
}

const collisionsPiso = []
for (let i = 0; i < pisoDato.length; i += 70) {
    collisionsPiso.push(pisoDato.slice(i, 70 + i))
}

const bordes = []
var layer = 0
const offset = {
    x: -256,
    y: -96
}

collisionsMap.forEach((row, i) => {
    row.forEach((symbol, j) => {
        if (symbol === 1025)
            bordes.push(
                new Borde({
                    position: {
                        x: j * Borde.width + offset.x,
                        y: i * Borde.height + offset.y
                    }
                }))
    })
})


const pasto1 = []
collisionsPasto1.forEach((row, i) => {
    row.forEach((symbol, j) => {
        if (symbol === 1025)
            pasto1.push(
                new Borde({
                    position: {
                        x: j * Borde.width + offset.x,
                        y: i * Borde.height + offset.y
                    }
                }))
    })
})

const piso1 = []
collisionsPiso.forEach((row, i) => {
    row.forEach((symbol, j) => {
        if (symbol === 1025)
            piso1.push(
                new Borde({
                    position: {
                        x: j * Borde.width + offset.x,
                        y: i * Borde.height + offset.y
                    }
                }))
    })
})


const image = new Image()
image.src = './img/mapa zoom.png'

const foregrou = new Image()
foregrou.src = './img/mapa zoom foreground.png'

const player = new Sprite({
    image: jugadorSprite,
    position: {
        x: canvas.width / 2 - 192 / 8,
        y: canvas.height / 2 - 68 / 2
    },
    frames: { max: 4, hold: 7 },
    sprites: {
        up: jugadorArriba,
        down: jugadorSprite,
        left: jugadorIzquierda,
        right: jugadorDerecha
    }
})

const background = new Sprite({
    position: {
        x: offset.x,
        y: offset.y
    },
    image: image
})

const foreground = new Sprite({
    position: {
        x: offset.x,
        y: offset.y
    },
    image: foregrou
})

const keys = {
    w: {
        pressed: false
    },
    a: {
        pressed: false
    },
    s: {
        pressed: false
    },
    d: {
        pressed: false
    }
}

const testBordes = new Borde({
    position: {
        x: 400,
        y: 400
    }
})

const movables = [background, foreground, ...bordes, ...pasto1, ...piso1]

function rectangularCollision({ rectangle1, rectangle2 }) {
    return (
        rectangle1.position.x + rectangle1.width - 12 >= rectangle2.position.x
        && rectangle1.position.x <= rectangle2.position.x + rectangle2.width - 12
        && rectangle1.position.y <= rectangle2.position.y + rectangle2.height - 40
        && rectangle1.position.y + rectangle1.height >= rectangle2.position.y

    )
}

const battle = {
    initiated: false
}

function animar() {
    battle.initiated = false
    const animationId = window.requestAnimationFrame(animar)
    c.fillStyle = 'black'
    c.fillRect(0, 0, canvas.width, canvas.height)
    background.draw()

    player.draw()
    foreground.draw()

    let movingUp = true
    let movingSide = true
    player.moving = false

    if (battle.initiated) return
    if (keys.w.pressed || keys.s.pressed || keys.a.pressed || keys.d.pressed) {

        for (let i = 0; i < pasto1.length; i++) {
            const pasto = pasto1[i]
            const overlappingArea = (Math.min(player.position.x +
                player.width, pasto.position.x + pasto.width) -
                Math.max(player.position.x, pasto.position.x)) * 
                (Math.min(player.position.y + player.height, pasto.position.y + pasto.height) -
                    Math.max(player.position.y, pasto.position.y))
            if (rectangularCollision({
                rectangle1: player,
                rectangle2: pasto
            }) && overlappingArea > (player.width * player.height) / 2) {
                layer = 1
                if (Math.random() < 0.05) {

                    audio.Mapa.stop()
                    audio.initBattle.play()
                    
                    audio.battle.play()

                    window.cancelAnimationFrame(animationId)
                    battle.initiated = true
                    gsap.to('#overlapdiv', {
                        opacity: 1,
                        repeat: 4,
                        yoyo: true,
                        duration: 0.4,
                        onComplete() {
                            initBattle()
                            animateBattle()
                            gsap.to('#overlapdiv', {
                                opacity: 0,
                                duration: 0.4,
                            })
                        }
                    })
                }
                break
            }
        }
        for (let i = 0; i < piso1.length; i++) {
            const piso = piso1[i]
            const overlappingArea = (Math.min(player.position.x +
                player.width, piso.position.x + piso.width) -
                Math.max(player.position.x, piso.position.x)) * (Math.min(player.position.y + player.height, piso.position.y + piso.height) -
                    Math.max(player.position.y, piso.position.y))
            if (rectangularCollision({
                rectangle1: player,
                rectangle2: piso
            }) && overlappingArea > (player.width * player.height) / 2) {
                layer = 2
                if (Math.random() < 0.01) {

                    audio.Mapa.stop()
                    audio.initBattle.play()
                    audio.battle.play()

                    window.cancelAnimationFrame(animationId)
                    battle.initiated = true
                    gsap.to('#overlapdiv', {
                        opacity: 1,
                        repeat: 4,
                        yoyo: true,
                        duration: 0.4,
                        onComplete() {
                            initBattle()
                            animateBattle()
                            gsap.to('#overlapdiv', {
                                opacity: 0,
                                duration: 0.4,
                            })
                        }
                    })
                }
                break
            }
        }
    }

    if (keys.w.pressed) {
        player.moving = true
        player.image = player.sprites.up
        for (let i = 0; i < bordes.length; i++) {
            const borde = bordes[i]
            if (rectangularCollision({
                rectangle1: player,
                rectangle2: {
                    ...borde, position: {
                        x: borde.position.x,
                        y: borde.position.y + 4
                    }
                }
            })) {
                movingUp = false
                break
            }
        }

        if (movingUp)
            movables.forEach((movable) => {
                movable.position.y += 4
            })
    }

    if (keys.s.pressed) {
        player.moving = true
        player.image = player.sprites.down
        for (let i = 0; i < bordes.length; i++) {
            const borde = bordes[i]
            if (rectangularCollision({
                rectangle1: player,
                rectangle2: {
                    ...borde, position: {
                        x: borde.position.x,
                        y: borde.position.y - 4
                    }
                }
            })) {
                movingUp = false
                break
            }
        }
        if (movingUp)
            movables.forEach((movable) => {
                movable.position.y -= 4
            })
    }
    if (keys.d.pressed) {
        player.moving = true
        player.image = player.sprites.right
        for (let i = 0; i < bordes.length; i++) {
            const borde = bordes[i]
            if (rectangularCollision({
                rectangle1: player,
                rectangle2: {
                    ...borde, position: {
                        x: borde.position.x - 4,
                        y: borde.position.y
                    }
                }
            })) {
                movingSide = false
                break
            }
        }
        if (movingSide)
            movables.forEach((movable) => {
                movable.position.x -= 4
            })
    }
    if (keys.a.pressed) {
        player.moving = true
        player.image = player.sprites.left
        for (let i = 0; i < bordes.length; i++) {
            const borde = bordes[i]
            if (rectangularCollision({
                rectangle1: player,
                rectangle2: {
                    ...borde, position: {
                        x: borde.position.x + 4,
                        y: borde.position.y
                    }
                }
            })) {
                movingSide = false
                break
            }
        }
        if (movingSide)
            movables.forEach((movable) => {
                movable.position.x += 4
            })
    }
}

animar()


window.addEventListener('keydown', (e) => {
    switch (e.key) {
        case 'w':
            keys.w.pressed = true
            break
        case 'a':
            keys.a.pressed = true
            break
        case 's':
            keys.s.pressed = true
            break
        case 'd':
            keys.d.pressed = true
            break
    }

})
window.addEventListener('keyup', (e) => {
    switch (e.key) {
        case 'w':
            keys.w.pressed = false
            break
        case 'a':
            keys.a.pressed = false
            break
        case 's':
            keys.s.pressed = false
            break
        case 'd':
            keys.d.pressed = false
            break
    }

})

let clicked = false
addEventListener('click',()=>{
    if (!clicked){
    audio.Mapa.play()
    clicked = true
}
})