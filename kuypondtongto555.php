<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.2/axios.min.js"
        integrity="sha512-QTnb9BQkG4fBYIt9JGvYmxPpd6TBeKp6lsUrtiVQsrJ9sb33Bn9s0wMQO9qVBFbPX3xHRAsBHvXlcsrnJjExjg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<body class="p-5">

  <h1>Tracking</h1>
  <hr>
  <div class="row">
    <div class="col-12 col-sm-4">
      <span>Tracking number</span>
      <input id="txt_tracking" type="text" class="form-control" placeholder="XXXXXXXXXX">
      <div class="mt-3 d-flex justify-content-end">
        <button onclick="searchnow()" class="btn btn-primary">Search</button>
      </div>
    </div>
    <div id="render" class="col-12 col-sm-8">
    <div class="card ${color} text-white p-3 mb-3">
                                        <div class="d-flex justify-content-between mb-2" style="border-bottom: 1px solid #adadad">
                                            <span>สถานะ</span>
                                    
                                        </div>
                                        <div class="d-flex justify-content-between mb-2" style="border-bottom: 1px solid #adadad">
                                            <span>สถานที่</span>
                                         
                                        </div>
                                        <div class="d-flex justify-content-between mb-2" style="border-bottom: 1px solid #adadad">
                                            <span>เวลา</span>
                                           
                                        </div>
                                    </div>
    </div>
  </div>
</body>
<script>
    function searchnow() {
  var tracking = document.querySelector("#txt_tracking");
  if (tracking.value.length <= 0) {
    alert("Please fill tracking number");
  } else {
    //get token
    var config = {
      method: "post",
      url: "https://trackapi.thailandpost.co.th/post/api/v1/authenticate/token",
      headers: {
        Authorization:
          "Token {GWZ4JCMEUfN+U=Z^IPCAV%UrSdYPEgTEH&T5GtRZLHNxMlLDBmSbL_CMDFTOXvV!U!TDM8V&AxBxYDNlW*OaGcY9G3KYRMUYVBE?}",
        "Content-Type": "application/json"
      }
    };

    axios(config)
      .then(function (response) {
        console.log(JSON.stringify(response.data));
        if (response.data.token && response.data.expire) {
          const token = response.data.token;

          var data = JSON.stringify({
            status: "all",
            language: "TH",
            barcode: [tracking.value]
          });

          var config = {
            method: "post",
            url: "https://trackapi.thailandpost.co.th/post/api/v1/track",
            headers: {
              Authorization: "Token " + token,
              "Content-Type": "application/json"
            },
            data: data
          };

          axios(config)
            .then(function (response) {
              console.log("final : ", response.data);
              if (response.data.message == "successful") {
                var render = document.querySelector("#render");
                var responsex = response.data.response.items[tracking.value];
                var html = "";
                for (let i = 0; i < responsex.length; i++) {
                  const element = responsex[i];

                  var color = "";
                  if (element.status == "501") {
                    color = "bg-success";
                  } else {
                    color = "bg-primary";
                  }

                  html += `
                                    <div class="card ${color} text-white p-3 mb-3">
                                        <div class="d-flex justify-content-between mb-2" style="border-bottom: 1px solid #adadad">
                                            <span>สถานะ</span>
                                            <span>${element.status_description}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2" style="border-bottom: 1px solid #adadad">
                                            <span>สถานที่</span>
                                            <span>${element.location}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2" style="border-bottom: 1px solid #adadad">
                                            <span>เวลา</span>
                                            <span>${element.status_date}</span>
                                        </div>
                                    </div>
                                    `;
                }
                render.innerHTML = html;
              } else {
                alert("Something is went wrong !");
              }
            })
            .catch(function (error) {
              console.log(error);
              alert("Something is went wrong !!");
            });
        } else {
          alert("Something is went wrong !!!");
        }
      })
      .catch(function (error) {
        console.log(error);
        alert("Something is went wrong !!!!");
      });
  }
}

</script>