        function ckUSER(str){
            //window.alert("well done");
            if(str==""){
                document.getElementById("invalidname").innerHTML="";
                flag=1;
                return;
            }
            else{
                if(window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
                }
                else{
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if(xmlhttp.readyState==4 && xmlhttp.status==200){
                        document.getElementById("invalidname").innerHTML=xmlhttp.responseText;
                        flag=0;
                    }
                };
                xmlhttp.open("GET","usernamevalidity_script.php?q="+str,true);
                xmlhttp.send();
            }//end else
        }//end fxn
