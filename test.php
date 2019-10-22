
<script type="text/javascript" src="resource/js/jquery-3.3.1.min.js"></script>

<button onclick="select_1('01')">a-01</button>
<button onclick="select_1('02')">a-02</button>
<button onclick="select_1('03')">a-03</button>
<hr>
<button onclick="select_2('11')">b-01</button>
<button onclick="select_2('12')">b-02</button>
<button onclick="select_2('13')">b-03</button>
<hr>
<button onclick="select_3('21')">c-01</button>
<button onclick="select_3('22')">c-02</button>
<button onclick="select_3('23')">c-03</button>
<hr>

<script type="text/javascript">

	function select_1(one)
	{
		$("#select_1").val( one );
		$("#item_cart").val( $("#select_1").val() + $("#select_2").val() + $("#select_3").val() );
	}
	function select_2(two)
	{
		$("#select_2").val( two );
		$("#item_cart").val( $("#select_1").val() + $("#select_2").val() + $("#select_3").val() );
	}
	function select_3(three)
	{
		$("#select_3").val( three );
		$("#item_cart").val( $("#select_1").val() + $("#select_2").val() + $("#select_3").val() );
	}
</script>

<input type="" id="select_1" value="00"><br>
<input type="" id="select_2" value="00"><br>
<input type="" id="select_3" value="00"><br>
<input type="" id="item_cart">