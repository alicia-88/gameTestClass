"use strict";
const canvas = document.getElementById("board");
const ctx = canvas.getContext("2d");
const turn = document.getElementById("turn");
let turnValue = turn.textContent;
// console.log(
//   heroRage,
//   orcDamage,
//   orcHealth,
//   heroHealth,
//   heroShieldValue,
//   heroWeaponDamage,
//   winner
// );
console.log(orcHealth);
console.log(heroHealth);
console.log(winner);
var drawGrid = function (w, h) {
  ctx.canvas.width = w;
  ctx.canvas.height = h;
};
const updateDom = (e) => {
  //   e.preventDefault();
  form.submit();
};
drawGrid(800, 600);
const form = document.getElementById("battle");
form.addEventListener("submit", updateDom);
window.onload = function () {
  const imgPerso6 = document.getElementById("perso6");
  const imgPerso3 = document.getElementById("perso3");
  const imgPerso4 = document.getElementById("perso4");
  const imgPerso7 = document.getElementById("perso7");
  const imgPerso8 = document.getElementById("perso8");
  const imgPerso9 = document.getElementById("perso9");
  const imgPerso10 = document.getElementById("perso10");
  const imgOrc1 = document.getElementById("orc1");
  const imgOrc2 = document.getElementById("orc2");
  const imgOrc3 = document.getElementById("orc3");
  const imgOrc5 = document.getElementById("orc5");
  const imgArme1 = document.getElementById("arme1");
  const imgSkull = document.getElementById("skull");
  let nIntervIdH;
  let moveH = 0;
  function attackHero() {
    ctx.drawImage(imgPerso6, 0, 200, 150, 200);
    nIntervIdH = setInterval(moveHero, 250);
  }
  function moveHero() {
    ctx.clearRect(0 + 120 * (moveH - 1), 200, 150, 200);
    ctx.drawImage(imgPerso6, 0 + 120 * moveH, 200, 150, 200);
    if (moveH > 1) {
      //ctx.scale(-1, 1);
      ctx.clearRect(650, 200, 150, 200);
      ctx.drawImage(imgOrc5, 650, 200, 150, 200);
    }
    if (moveH == 4) {
      clearInterval(nIntervIdH);

      ctx.clearRect(0 + 120 * moveH, 200, 150, 200);
    }
    moveH++;
  }

  let nIntervIdW;
  let moveW = 0;
  function throwWeapon() {
    ctx.drawImage(imgArme1, 610, 150, 40, 40);
    nIntervIdW = setInterval(moveWeapon, 250);
  }
  function moveWeapon() {
    console.log("ok");
    ctx.clearRect(610 - 115 * (moveW - 1), 150 + 15 * (moveW - 1), 40, 40);
    ctx.drawImage(imgArme1, 610 - 115 * moveW, 150 + 15 * moveW, 40, 40);
    if (moveW == 2) {
      ctx.clearRect(650, 200, 150, 200);
      ctx.drawImage(imgOrc2, 650, 200, 150, 200);
    }
    if (moveW == 5) {
      clearInterval(nIntervIdW);
      ctx.clearRect(0, 200, 150, 200);
      if (heroShieldValue >= 600) {
        ctx.drawImage(imgPerso6, 0, 200, 150, 200);
      } else if (heroShieldValue >= 400) {
        ctx.drawImage(imgPerso7, 0, 200, 150, 200);
      } else if (heroShieldValue >= 200) {
        ctx.drawImage(imgPerso8, 0, 200, 150, 200);
      } else {
        ctx.drawImage(imgPerso9, 0, 200, 150, 200);
      }
    }
    moveW++;
  }

  //;

  if (winner == "orc") {
    ctx.clearRect(650, 200, 150, 200);
    ctx.clearRect(0, 200, 150, 200);
    ctx.drawImage(imgOrc3, 650, 200, 150, 200);
    ctx.drawImage(imgPerso10, 0, 200, 150, 200);
  } else if (winner == "hero") {
    ctx.clearRect(650, 200, 150, 200);
    ctx.clearRect(0, 200, 150, 200);
    ctx.drawImage(imgSkull, 650, 200, 150, 200);
    ctx.drawImage(imgPerso4, 0, 200, 150, 200);
  } else {
    ctx.drawImage(imgOrc1, 650, 200, 150, 200);
    if (heroRage >= 90) {
      throwWeapon();
      attackHero();
    } else {
      ctx.drawImage(imgPerso6, 0, 200, 150, 200);
      throwWeapon();
    }
  }
};
