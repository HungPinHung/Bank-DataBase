addEventListener("load",async ()=>{
    const user_data_connect = await fetch("../__SQL/User_Info.php");
    let user_data = await user_data_connect.text();

    const user_data_json = JSON.parse(user_data);

    

    let content_block = [
        {
            tag:"user_money",
            data:"帳戶餘額"
        },
        {
            tag:"user_email",
            data:"Email"
        },
        {
            tag:"user_account_number",
            data:"擁有帳戶數量"
        },
        {
            tag:"user_trade_number",
            data:"交易次數"
        },
        {
            tag:"user_name",
            data:"Frist_Name,Last_Name"
        },
        {
            tag:"user_phone",
            data:"Phone_Number"
        },
        {
            tag:"user_SSN",
            data:"SSN_Number"
        },
        {
            tag:"user_ID",
            data:"User_ID"
        },
        {
            tag:"SQL_command",
            data:"SQL_COMMAND"
        }
    ]

    for(i=0;i<content_block.length;i++){
        const selectElement = document.querySelector("[content-block-tag='" + content_block[i].tag + "']");

        const SQL_data = content_block[i].data.split(',');

        let data_text = "";

        for(j=0;j<SQL_data.length;j++){
            data_text += user_data_json[SQL_data[j]] + " ";
        }

        selectElement.innerHTML = data_text;
    }
});