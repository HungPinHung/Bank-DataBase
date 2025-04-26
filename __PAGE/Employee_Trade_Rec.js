addEventListener("load",async ()=>{
    const user_data_connect = await fetch("../__SQL/Employee_Trade_Rec.php");
    let user_data = await user_data_connect.text();

    user_data = user_data.replaceAll("\n",'');
    user_data = user_data.replaceAll("\r",'');

    const user_data_json = JSON.parse(user_data);

    tableAdd(user_data_json.Data);

    const SQL_command = document.querySelector("[content-block-tag='SQL_command']");

    SQL_command.innerHTML = user_data_json.SQL_COMMAND;
});