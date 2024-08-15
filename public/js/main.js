class GetData {
    constructor(newUrl) {
        this.url = newUrl;
        this.data = null;
    }

    async getJson() {
        await $.ajax({
            url: this.url,
            method: 'GET',
            dataType: 'json',
            success: (data) => {
                this.data = data;
            }
        });
        return this.data;
    }
}

class Slideshow{
    id;
    images;
    alt;
    div;
    constructor(id, images, alt) {
        this.id         = id;
        this.images     = images;
        this.alt        = alt;
        this.div        = $('#' + this.id);

        for (let i = 0; i < this.images.length; i++){
            var image = $('<img/>')
                .attr('id', this.id + "-" + i)
                .attr('src', this.images[i])
                .attr('alt', this.alt + ", photo " + (i + 1))
                .addClass('mySlides fade');
            $('#' + this.id).append(image);
        }

    }
}

class Main {
    data;
    item;
    constructor(data) {
        this.data = data;
        $(".js--sauna__placeholder").each(function(index){
           this.item = data[index];
            new Slideshow(this.item.id, this.item.images, "Photo van "+ this.item.name)
            $(this).css('display', 'none');
            $('.sauna__images').css('display', 'block');
        });
    }

}

class App {
    constructor() {
        this.api = new GetData("/data");
        this.api.getJson().then((data) => {
            new Main(data);
        });
    }
}
$(document).ready(function() {
    const app = new App();
});


class Slidecode{
    array = [];
    object;
    showSlides(id, n) {
        this.object = this.addItemIfNotExists(id);
        if (this.object.index === 0 && n === -1) {
            this.object.index = 4;
        }else if(this.object.index === 4 && n === 1){
            this.object.index = 0;
        }else{
            this.object.index += n;
        }

        for (let i = 0;i < 5;i++){
            $('#' + this.object.id + "-" + i).css('display', 'none');
        }
        $('#' + this.object.id + "-" + this.object.index).css('display', 'block');
    }
    addItemIfNotExists(id) {
        const index = this.array.findIndex(item => item.id === id);
        let item;

        if (index === -1) {
            item = { id: id, index: 0};
            this.array.push(item);
        } else {
            item = this.array[index];
        }

        return item;
    }
}

$(document).ready(function() {
    const slidecode = new Slidecode();

    window.plusSlides = function(n, id) {
        slidecode.showSlides(id, n);
    }
});


