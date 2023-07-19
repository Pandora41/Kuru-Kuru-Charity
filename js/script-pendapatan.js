const hireBtn = document.querySelectorAll("#hireBtn");
const popOuter = document.querySelector(".pop-outer");
const closeBtn = popOuter.querySelector("#closeBtn");
hireBtn.forEach((popbtn) => {
    popbtn.addEventListener("click", () => {
      popOuter.classList.add("active");
    });
  });
closeBtn.addEventListener("click", () => {
    popOuter.classList.remove("active");
});

const addBtn = document.querySelectorAll("#addBtn");
const popAdd= document.querySelector(".pop-add");
const closeBtn1 = popAdd.querySelector("#closeBtn");
addBtn.forEach((popbtn) => {
    popbtn.addEventListener("click", () => {
      popAdd.classList.add("active");
    });
  });
closeBtn1.addEventListener("click", () => {
    popAdd.classList.remove("active");
});