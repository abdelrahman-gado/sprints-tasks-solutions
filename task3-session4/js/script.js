function showList() {
  const list = document.getElementById('hidden-list');
  let visibility = getComputedStyle(list).visibility;
  let height = getComputedStyle(list).height;


  if (height === "0px") {
    list.style.visibility = "visible";
    list.style.height = "200px";
  } else {
    list.style.visibility = "hidden";
    list.style.height = "0px";
  }
}