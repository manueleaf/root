const battleBackgroundImg = new Image()
battleBackgroundImg.src = './img/battleBackground.png'
const battleBackground = new Sprite({
    position: {
        x: 0, y: 0
    }, image: battleBackgroundImg
})

let draggle
let pelea
let renderedSprites
let battleAnimationId
let queue



function initBattle() {
    document.querySelector('#UI').style.display = 'block'
    document.querySelector('#dialogos').style.display = 'none'
    document.querySelector('#enemyHealth').style.width = '100%'
    document.querySelector('#playerHealth').style.width = '100%'
    document.querySelector('#cajasdeAtaque').replaceChildren()
    draggle = new Monster(monsters[layer])
    document.querySelector('#nombreMonstruo').innerHTML = draggle.name
    pelea = new Monster(monsters[0])
    renderedSprites = [draggle, pelea]
    queue = []

    pelea.attacks.forEach(attack => {
        const button = document.createElement('button')
        button.setAttribute('style', 'font-size: 30px')
        button.innerHTML = attack.name
        document.querySelector('#cajasdeAtaque').append(button)
    })

    document.querySelectorAll('button').forEach(button => {
        button.addEventListener('click', (e) => {
            const selectedAttack = attacks[e.currentTarget.innerHTML]
            pelea.attack({
                attack: selectedAttack,
                recipient: draggle,
                renderedSprites
            })

            if (draggle.health <= 0) {
                queue.push(() => {
                    draggle.faint()
                })
                queue.push(() => {
                    endBattle()
                })
            }

            const randomAttack = draggle.attacks[Math.floor(Math.random() * draggle.attacks.length)]

            queue.push(() => {
                draggle.attack({
                    attack: randomAttack,
                    recipient: pelea,
                    renderedSprites
                })

                if (pelea.health <= 1) {
                    queue.push(() => {
                        pelea.faint()
                    })
                    queue.push(() => {
                        endBattle()
                    })
                }
            })

        })
    })
}

function animateBattle() {
    battleAnimationId = window.requestAnimationFrame(animateBattle)
    battleBackground.draw()
    renderedSprites.forEach((sprite) => { sprite.draw() })
}

//initBattle()
//animateBattle()

function endBattle(){
    gsap.to('#overlapdiv', {
        opacity: 1,
        onComplete: () => {
            audio.battle.stop()
            cancelAnimationFrame(battleAnimationId)
            animar()
            document.querySelector('#UI').style.display = 'none'
            gsap.to('#overlapdiv', {
                opacity: 0
            })
        }
    })
}

document.querySelector('#dialogos').addEventListener('click', (e) => {
    if (queue.length > 0) {
        queue[0]()
        queue.shift()
    } else
        e.currentTarget.style.display = 'none'
})

document.querySelector('#Huida').addEventListener('click', (e) => {
    if (Math.random() > 0.5) {
        document.querySelector('#dialogos').style.display = 'block'
        document.querySelector('#dialogos').innerHTML = 'Escapaste con exito'
        queue.push(() => {
            endBattle()
        })
    }
    else {
        document.querySelector('#dialogos').style.display = 'block'
        document.querySelector('#dialogos').innerHTML = 'No pudiste huir!'
        const randomAttack = draggle.attacks[Math.floor(Math.random() * draggle.attacks.length)]
        queue.push(() => {
            draggle.attack({
                attack: randomAttack,
                recipient: pelea,
                renderedSprites
            })
        })

    }
}
)