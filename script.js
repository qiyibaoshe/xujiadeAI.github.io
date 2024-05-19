/* script.js */
function checkContent() {
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'check_content.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      // 使用setTimeout模拟逐字输出
      outputContent(xhr.responseText);
    }
  };
  var content = document.getElementById("contentInput").value;
  xhr.send('content=' + content);
}

function outputContent(text) {
  var index = 0;
  var div = document.getElementById('result');
  div.innerHTML = ''; // 清空结果容器

  function printChar() {
    if (index < text.length) {
      // 输出下一个字符
      div.innerHTML += text.charAt(index);
      index++;
      // 随机延迟0.01到1秒
      var delay = Math.random() * (0.1 - 0.01) + 0.01;
      setTimeout(printChar, delay * 1000); // 转换为毫秒
    }
  }

  printChar();
}
