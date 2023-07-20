const hireBtn = document.querySelectorAll(".hireBtn");
const popOuter = document.querySelector(".pop-outer");
const closeBtn = popOuter.querySelector("#closeBtn");
const nisInput1 = popOuter.querySelector("#nisInput");
const namaInput1 = popOuter.querySelector("#namaInput");
const bulanInput1 = popOuter.querySelector("#bulanInput");
const kelasInput1 = popOuter.querySelector("#kelasInput");
const nominalInput1 = popOuter.querySelector("#nominalInput");
const nominalAwalInput1 = popOuter.querySelector("#nominalAwalInput");
const nisInput11 = popOuter.querySelector("#nisInput11");

hireBtn.forEach((popbtn) => {
  popbtn.addEventListener("click", () => {
    const nisValue1 = popbtn.dataset.nis;
    const namaValue1 = popbtn.dataset.nama;
    const bulanValue1 = popbtn.dataset.bulan;
    const kelasValue1 = popbtn.dataset.kelas;
    const nominalValue1 = popbtn.dataset.nominal;

    nisInput1.value = nisValue1;
    namaInput1.value = namaValue1;
    bulanInput1.value = bulanValue1;
    kelasInput1.value = kelasValue1;
    nominalInput1.value = nominalValue1;
    nominalAwalInput1.value = nominalValue1;
    nisInput11.value = nisValue1;

    popOuter.classList.add("active");
  });
});

const closeForm1 = () => {
  popOuter.classList.remove("active");
};

closeBtn.addEventListener("click", closeForm1);

const addBtns = document.querySelectorAll(".addBtn");
const popAdd = document.querySelector(".pop-add");
const closeBtn1 = popAdd.querySelector("#closeBtn");
const nisInput = popAdd.querySelector("#nisInput");
const namaInput = popAdd.querySelector("#namaInput");
const bulanInput = popAdd.querySelector("#bulanInput");
const kelasInput = popAdd.querySelector("#kelasInput");

addBtns.forEach((addBtn) => {
  addBtn.addEventListener("click", () => {
    const nisValue = addBtn.dataset.nis;
    const namaValue = addBtn.dataset.nama;
    const bulanValue = addBtn.dataset.bulan;
    const kelasValue = addBtn.dataset.kelas;
    nisInput.value = nisValue;
    namaInput.value = namaValue;
    bulanInput.value = bulanValue;
    kelasInput.value = kelasValue;
    popAdd.classList.add("active");
  });
});

const closeForm = () => {
  popAdd.classList.remove("active");
};

closeBtn1.addEventListener("click", closeForm);



// hireBtn.forEach((popbtn) => {
//   popbtn.addEventListener("click", () => {
//     popOuter.classList.add("active");
//   });
// });
// closeBtn.addEventListener("click", () => {
//   popOuter.classList.remove("active");
// });
