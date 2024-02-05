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
        figure.innerHTML = `<img src="https://picsum.photos/id/${Math.floor(Math.random() * (200 - 1 + 1) + 1)}/20" alt=""/>`;
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

export default () => {
    let form = document.querySelector("#send-message");

    form.addEventListener("submit", function(event){
        event.preventDefault();

        let chanInput = document.querySelector("#chan-id");
        let contentInput = document.querySelector("#message");

        if(chanInput.value.length > 0 && contentInput.value.length > 0)
        {
            let formData = new FormData();
            formData.append('chan-id', chanInput.value);
            formData.append('message', contentInput.value);

            const options = {
                method: 'POST',
                body: formData
            };

            fetch('http://localhost:63342/bre01-distorsion/index.php?route=send-message', options)
                .then(response => response.json())
                .then(data => {
                    contentInput.value = "";
                    loadChannel(data.channel, data.messages);
                });

        }
    })

};