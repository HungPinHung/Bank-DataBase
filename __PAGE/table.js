function tableAdd(data){
    const parent = document.querySelector("[content-block-tag='data_table']");

    //清空
    parent.innerHTML = "";

    //產生thead，每個陣列第一筆的名稱就是
    const thead_content = Object.keys(data[0]);

    let thead = document.createElement('thead');

    let tr = document.createElement('tr');

    let new_thead_parent = parent.appendChild(thead);

    let new_th_parent = new_thead_parent.appendChild(tr);

    //循環產生
    for(i=0;i<thead_content.length;i++){
        const th = document.createElement('th');

        th.innerHTML = thead_content[i];

        new_th_parent.appendChild(th);
    }

    //生成資料
    const tbody = document.createElement('tbody');

    const new_tbody_parent = parent.appendChild(tbody);

    const data_length = data.length;

    for(k=0;k<data_length;k++){
        tr = document.createElement('tr');

        let new_data_th_parent = new_tbody_parent.appendChild(tr);
        
        for(j=0;j<thead_content.length;j++){
            const th = document.createElement('th');

            th.innerHTML = data[k][thead_content[j]];

            new_data_th_parent.appendChild(th);
        }
    }
}