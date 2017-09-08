var nameEl = document.getElementById('release-classify');

var first = []; /* 省，直辖市 */
var second = []; /* 市 */
//var third = []; /* 镇 */

var checked = [0, 0]; /* 已选选项 */

function creatList(obj, list) {
    obj.forEach(function (item, index, arr) {
        var temp = new Object();
        temp.text = item.title;
        temp.value = item.id;
        list.push(temp);
    })
}

creatList(city, first);

if (city[0].hasOwnProperty('sub')) {
    creatList(city[0].sub, second);
} else {
    second = [{text: '', value: 0}];
}

/*if (city[0].sub[0].hasOwnProperty('sub')) {
 creatList(city[0].sub[0].sub, third);
 } else {
 third = [{text: '', value: 0}];
 }*/

var picker = new Picker({
    data: [first, second],
    selectedIndex: [0, 0],
    title: ''
});

picker.on('picker.select', function (selectedVal, selectedIndex) {
    var text1 = first[selectedIndex[0]].text;
    var text2 = second[selectedIndex[1]].text;
    //var text3 = third[selectedIndex[2]] ? third[selectedIndex[2]].text : '';

    nameEl.value = text1 + ' ' + text2;// + ' ' + text3;
});

picker.on('picker.change', function (index, selectedIndex) {
    if (index === 0) {
        firstChange();
    } else if (index === 1) {
        secondChange();
    }

    function firstChange() {
        second = [];
        //third = [];
        checked[0] = selectedIndex;
        var firstCity = city[selectedIndex];
        if (firstCity.hasOwnProperty('sub')) {
            creatList(firstCity.sub, second);

            /*var secondCity = city[selectedIndex].sub[0]
             if (secondCity.hasOwnProperty('sub')) {
             creatList(secondCity.sub, third);
             } else {
             third = [{text: '', value: 0}];
             checked[2] = 0;
             }*/
        } else {
            second = [{text: '', value: 0}];
            //third = [{text: '', value: 0}];
            checked[1] = 0;
            //checked[2] = 0;
        }

        picker.refillColumn(1, second);
        //picker.refillColumn(2, third);
        picker.scrollColumn(1, 0)
        //picker.scrollColumn(2, 0)
    }

    function secondChange() {
        third = [];
        checked[1] = selectedIndex;
        var first_index = checked[0];
        if (city[first_index].sub[selectedIndex].hasOwnProperty('sub')) {
            var secondCity = city[first_index].sub[selectedIndex];
            //creatList(secondCity.sub, third);
            //picker.refillColumn(2, third);
            //picker.scrollColumn(2, 0)
        } else {
            //third = [{text: '', value: 0}];
            checked[2] = 0;
            //picker.refillColumn(2, third);
            //picker.scrollColumn(2, 0)
        }
    }

});

picker.on('picker.valuechange', function (selectedVal, selectedIndex) {
    $('#pid').val(selectedVal[0]);
    $('#cid').val(selectedVal[1]);
});

nameEl.addEventListener('click', function () {
    picker.show();
});



