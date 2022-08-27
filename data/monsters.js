const jugadorSprite = new Image()
jugadorSprite.src = './img/character/playerDown.png'

const jugadorArriba = new Image()
jugadorArriba.src = './img/character/playerUp.png'

const jugadorIzquierda = new Image()
jugadorIzquierda.src = './img/character/playerLeft.png'

const jugadorDerecha = new Image()
jugadorDerecha.src = './img/character/playerRight.png'

const monsters = {
    0: {
        position: {
            x: 320, y: 325
        }, image: {src: './img/character/playerUp.png'},
        frames: {max: 4, hold:30}, ani: true, 
        attacks: [attacks.Placaje, attacks.Fuego, attacks.Congelar]
    },
    1: {
        position: {
            x: 800, y: 100
        }, image: {src: './img/draggleSprite.png'},
        frames: {max: 4, hold: 30}, ani: true,
        isEnemy: true, attacks: [attacks.Placaje, attacks.Congelar],
        name: 'Oruga'
    },

    2: {
        position: {
            x: 800, y: 100
        }, image: {src: './img/monsters/8.png'},
        frames: {max: 4, hold: 30}, ani: true,
        isEnemy: true, attacks: [attacks.Fuego, attacks.Fuego],
        name: 'Ojo'
    }
}