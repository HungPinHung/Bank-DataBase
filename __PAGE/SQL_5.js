async function search(){
    let user_input_UUID = document.querySelector("[content-block-tag='UUID']").value;

    user_input_UUID = user_input_UUID.replaceAll(" ","");
    user_input_UUID = user_input_UUID.replaceAll("\n","");
    user_input_UUID = user_input_UUID.replaceAll("\r","");
    user_input_UUID = user_input_UUID.replaceAll("\t","");

    user_input_UUID = user_input_UUID.replaceAll("+","%2B");


    if(user_input_UUID == ""){
        alert("請輸入UUID");
        return;
    }

    const user_data_connect = await fetch("../__SQL/SQL_5.php?UUID=" + user_input_UUID);
    let user_data = await user_data_connect.text();

    user_data = user_data.replaceAll("\n",'');
    user_data = user_data.replaceAll("\r",'');
    user_data = user_data.replaceAll("\t",'');

    if(user_data == "error"){
        alert("查無資料");
        return;
    }

    const user_data_json = JSON.parse(user_data);

    tableAdd(user_data_json.Data);

    const SQL_command = document.querySelector("[content-block-tag='SQL_command']");

    SQL_command.innerHTML = user_data_json.SQL_COMMAND;
}