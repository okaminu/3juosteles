function bodyInit()
{
//Paieskos irasymas
search=document.getElementById("s");
search.value="Ieškomas raktažodis";

search1=document.getElementById("skelk");
search1.value="TAVO TEKSTAS";
//Cookie Init
setCookie("Skaitalai", 0, 1);
setCookie("Video", 0, 1);
setCookie("Audio", 0, 1);
setCookie("Foto", 0, 1);
setCookie("Sms", 0, 1);
}
//Sausainiukai
function getCookie(c_name)
{
var i,x,y,ARRcookies=document.cookie.split(";");
for (i=0;i<ARRcookies.length;i++)
  {
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x==c_name)
    {
    return unescape(y);
    }
  }
}

function setCookie(c_name,value,exdays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
document.cookie=c_name + "=" + c_value;
}

function checkCookie()
{
var username=getCookie("username");
if (username!=null && username!="")
  {
  alert("Welcome again " + username);
  }
else
  {
  username=prompt("Please enter your name:","");
  if (username!=null && username!="")
    {
    setCookie("username",username,365);
    }
  }
}
//---ISKLEIDZIAMO MENIU SISTEMA---

function MeniuClose(id)
{
//---Sumazinamos Raides---
sritis=document.getElementById(id);
sritis.setAttribute("class", "sritisUnMarked");
//---Uzdaromas SubMeniu---
subID=id+"Sub";
subSritis=document.getElementById(subID);
subSritis.setAttribute("class", "SubMeniuHidden");

}

function MeniuOpen(id)
{
//---Padidinamos raides---
sritis=document.getElementById(id);
sritis.setAttribute("class", "sritisMarked");
//---Atidaromas SubMeniu---
subID=id+"Sub";
subSritis=document.getElementById(subID);
subSritis.setAttribute("class", "SubMeniuVisible");

}




