async function search(){
    let user_input_Time = document.querySelector("[content-block-tag='Time']").value;

    if(user_input_Time == ""){
        alert("請輸入Time");
        return;
    }

    alert(user_input_Time);

    const user_data_connect = await fetch("../__SQL/SQL_2.php?Time=" + user_input_Time);
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