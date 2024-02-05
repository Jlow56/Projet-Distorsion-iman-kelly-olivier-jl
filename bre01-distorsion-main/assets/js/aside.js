function addCategoryToAside(category) {

    let aside = document.querySelector("aside");

    // adding the form open button

    let h3 = document.createElement("h3");
    let btn = document.createElement("button");
    let btnSpan = document.createElement("span");
    h3.innerText = category.name;
    btn.classList.add("btn-add-channel");
    btn.setAttribute("data-cat", category.id);
    btn.setAttribute("aria-label", "Open the add channel form");
    btnSpan.classList.add("bi");
    btnSpan.classList.add("bi-plus-circle");

    let ul = document.createElement("ul");
    ul.setAttribute("data-cat", category.id);

    btn.appendChild(btnSpan);
    h3.appendChild(btn);
    aside.appendChild(h3);
    aside.appendChild(ul);

    btn.addEventListener("click", toggleChannelForm);

    // adding the add channel form

    let form = document.createElement("form");
    let inputCat = document.createElement("input");
    let inputChan = document.createElement("input");
    let formBtn = document.createElement("button");
    let formBtnSpan = document.createElement("span");

    form.classList.add("add-channel");
    form.classList.add("closed");
    form.setAttribute("data-cat", category.id);
    inputCat.setAttribute("type", "hidden");
    inputCat.setAttribute("name", "cat-id");
    inputCat.setAttribute("id", "cat-id");
    inputCat.setAttribute("value", category.id);
    inputChan.setAttribute("type", "text");
    inputChan.setAttribute("name", "chan-name");
    inputChan.setAttribute("id", "chan-name");
    inputChan.setAttribute("aria-label", "Channel Name");
    formBtn.setAttribute("type", "submit");
    formBtn.setAttribute("aria-label", "Add");
    formBtnSpan.classList.add("bi");
    formBtnSpan.classList.add("bi-check2")

    form.appendChild(inputCat);
    form.appendChild(inputChan);
    formBtn.appendChild(formBtnSpan);
    form.appendChild(formBtn);

    form.addEventListener("submit", addChannel);

    aside.appendChild(form);
}

function addCategory(event) {
    event.preventDefault();

    let form = event.target;

    let name = form.elements[0].value;

    if (name.length > 0) {
        let formData = new FormData();
        formData.append('cat-name', name);

        const options = {
            method: 'POST',
            body: formData
        };

        fetch('http://localhost:63342/bre01-distorsion/index.php?route=create-category', options)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                addCategoryToAside(data.category);
            });
    }
}

function addChannelToAside(channel)
{
    let ul = document.querySelector(`ul[data-cat="${channel.category}"]`);
    let li = document.createElement("li");
    li.setAttribute("data-chan", channel.id);
    li.innerText = channel.name;
    li.addEventListener("click", switchChannel);

    ul.appendChild(li);
}

function addChannel(event)
{
    event.preventDefault();

    let form = event.target;

    let category = form.elements[0].value;
    let name = form.elements[1].value;

    if(name.length > 0)
    {
        let formData = new FormData();
        formData.append('chan-name', name);
        formData.append('cat-id', category);

        const options = {
            method: 'POST',
            body: formData
        };

        fetch('http://localhost:63342/bre01-distorsion/index.php?route=create-channel', options)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                addChannelToAside(data.channel);
            });
    }
}

function toggleCategoryForm(event)
{
    let form = document.getElementById("add-category");
    let span = document.querySelector("#btn-add-category span");

    form.classList.toggle("closed");
    form.classList.toggle("open");
    span.classList.toggle("bi-plus-circle");
    span.classList.toggle("bi-dash-circle");

    form.addEventListener("submit", addCategory);
}

function toggleChannelForm(event)
{
    let dataCat;

    if(event.target.parentElement)
    {
        dataCat = event.target.parentElement.getAttribute("data-cat");
    }
    else
    {
        dataCat = event.target.getAttribute("data-cat");
    }

    let form = document.querySelector(`form[data-cat="${dataCat}"]`);
    let span = document.querySelector(`button[data-cat="${dataCat}"] span`);

    form.classList.toggle("closed");
    form.classList.toggle("open");
    span.classList.toggle("bi-plus-circle");
    span.classList.toggle("bi-dash-circle");

    form.addEventListener("submit", addChannel);
}

function loadChannel(channel, messages)
{
    console.log(channel);
    let input = document.querySelector("#chat #chan-id");
    input.value = channel.id;

    let ul = document.querySelector("#chat > ul");
    ul.innerHTML = "";

    let h2 = document.createElement("h2");
    h2.innerText = channel.name;

    ul.appendChild(h2);

    messages.forEach((item) => {
        let li = document.createElement("li");
        let article = document.createElement("article");

        let header = document.createElement("header");
        let figure = document.createElement("figure");
        figure.innerHTML = `<img src="${item.image}" alt="" width="20" height="20"/>`;
        let author = document.createElement("p");
        author.innerText = item.user;
        header.appendChild(figure);
        header.appendChild(author);
        article.appendChild(header);

        let content = document.createElement("p");
        content.innerText = item.content;
        article.appendChild(content);

        let footer = document.createElement("footer");
        let date = document.createElement("p");
        date.innerText = item.created_at;
        footer.appendChild(date);
        article.appendChild(footer);

        li.appendChild(article);
        ul.appendChild(li);
    });
}

function switchChannel(event)
{
    let li = event.target;
    let chanId = li.getAttribute("data-chan");

    fetch('http://localhost:63342/bre01-distorsion/index.php?route=chat&channel=' + chanId)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            loadChannel(data.channel, data.messages);
        });
}

export default () => {
    let addCategoryBtn = document.getElementById("btn-add-category");
    let addChannelBtns = document.querySelectorAll(".btn-add-channel");
    let channelsLi = document.querySelectorAll("aside li");

    addCategoryBtn.addEventListener("click", toggleCategoryForm);
    addChannelBtns.forEach((btn) => {
        btn.addEventListener("click", toggleChannelForm);
    })

    channelsLi.forEach((li) => {
        li.addEventListener("click", switchChannel);
    })
};