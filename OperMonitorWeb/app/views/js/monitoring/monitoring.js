function showMonitoring() {
	hideAllPannels();
	document.getElementById("RootBlade").classList.remove("opm-hidden");
	document.getElementById("MonitoringBlade").classList.remove("opm-hidden");
	document.getElementById("MonitoringBladeLeft").classList.remove("opm-hidden");
	document.getElementById("MonitoringBladeLeft").classList.add("opm-blade-left-long");
	hideDashboardPannel();
	loadMonitoringInfo();
}

function hideMonitoringLeft(){
	document.getElementById("RootBlade").classList.remove("opm-hidden");
	document.getElementById("MonitoringBlade").classList.add("opm-hidden");
	document.getElementById("MonitoringBladeLeft").classList.add("opm-hidden");
	document.getElementById("MonitoringBladeLeft").classList.remove("opm-blade-left-long");
	showDashboardPannel();
}

function loadMonitoringInfo(){
	GetDataFromItem("opm-monitoring-loading", "monitoring.left.loading").classList.remove("opm-hidden");
	GetDataFromItem("opm-monitoring-pie", "monitoring.left.pieprocessorusage").classList.add("opm-hidden");
	GetDataFromItem("opm-monitoring-pie", "monitoring.left.pieramusage").classList.add("opm-hidden");
	GetDataFromItem("opm-monitoring-pie", "monitoring.left.piediskusage").classList.add("opm-hidden");
	GetDataFromItem("opm-monitoring-part", "monitoring.left.part.computerscount").classList.add("opm-hidden");
	GetDataFromItem("opm-monitoring-part", "monitoring.left.part.logineventscount").classList.add("opm-hidden");
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{monitoring:"getmonitoring"},
		success:function(data){
			var monitor = data;
			monitor = monitor.replace('','');
			monitor = JSON.parse(monitor);
			var ramlimit = parseInt(monitor.ramlimit);
			var ramusage = parseInt(monitor.ramusage);
			var processorusage = parseInt(monitor.processorusage);
			var diskusage = parseInt(monitor.diskusage);
			
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawProcessorUsage);
			google.charts.setOnLoadCallback(drawRamUsage);
			google.charts.setOnLoadCallback(drawDiskUsage);

			function drawProcessorUsage() {
				var free = 100 - processorusage;
				
				var data = google.visualization.arrayToDataTable([
				  ['Processor usage', 'Percentage'],
				  ['Used',     processorusage],
				  ['Free',     free]
				]);

				var options = {
				  title: 'Processor usage',
				  fontsize:16,
				  fontsize:'az_ea_font,wf_segoe-ui_semibold,"Segoe UI Semibold","Segoe WP Semibold","Segoe UI","Segoe WP",Tahoma,Arial,sans-serif;',
				  width:800,
				  height:500
				};

				var chart = new google.visualization.PieChart(document.getElementById('pieprocessorusage'));
				chart.draw(data, options);
			}
			
			function drawRamUsage() {
				var usage = ((ramusage / 1024) * 100) / ramlimit;
				var free = 100 - usage;
				
				var data = google.visualization.arrayToDataTable([
				  ['Ram usage', 'Percentage'],
				  ['Used',     usage],
				  ['Free',     free]
				]);

				var options = {
				  title: 'Ram usage',
				  fontsize:16,
				  fontsize:'az_ea_font,wf_segoe-ui_semibold,"Segoe UI Semibold","Segoe WP Semibold","Segoe UI","Segoe WP",Tahoma,Arial,sans-serif;',
				  width:800,
				  height:500
				};

				var chart = new google.visualization.PieChart(document.getElementById('pieramusage'));
				chart.draw(data, options);
			}
			
			function drawDiskUsage() {
				var free = 100 - diskusage;
				
				var data = google.visualization.arrayToDataTable([
				  ['Disk usage', 'Percentage'],
				  ['Used',     diskusage],
				  ['Free',     free]
				]);

				var options = {
				  title: 'Disk usage',
				  fontsize:16,
				  fontsize:'az_ea_font,wf_segoe-ui_semibold,"Segoe UI Semibold","Segoe WP Semibold","Segoe UI","Segoe WP",Tahoma,Arial,sans-serif;',
				  width:800,
				  height:500
				};

				var chart = new google.visualization.PieChart(document.getElementById('piediskusage'));
				chart.draw(data, options);
			}
			
			GetDataFromItem("opm-monitoring-content-infodown", "monitoring.left.part.computerscount.value").innerHTML = monitor.computerscount;
			GetDataFromItem("opm-monitoring-content-infodown", "monitoring.left.part.logineventscount.value").innerHTML = monitor.logineventscount;
			GetDataFromItem("opm-monitoring-content-infodown", "monitoring.left.part.logineventscounttoday.value").innerHTML = monitor.logineventscounttoday;
			GetDataFromItem("opm-monitoring-content-infodown", "monitoring.left.part.logineventscountweek.value").innerHTML = monitor.logineventscountweek;
			GetDataFromItem("opm-monitoring-content-infodown", "monitoring.left.part.logineventscountmonth.value").innerHTML = monitor.logineventscountmonth;
			GetDataFromItem("opm-monitoring-loading", "monitoring.left.loading").classList.add("opm-hidden");
			GetDataFromItem("opm-monitoring-pie", "monitoring.left.pieprocessorusage").classList.remove("opm-hidden");
			GetDataFromItem("opm-monitoring-pie", "monitoring.left.pieramusage").classList.remove("opm-hidden");
			GetDataFromItem("opm-monitoring-pie", "monitoring.left.piediskusage").classList.remove("opm-hidden");
			GetDataFromItem("opm-monitoring-part", "monitoring.left.part.computerscount").classList.remove("opm-hidden");
			GetDataFromItem("opm-monitoring-part", "monitoring.left.part.logineventscount").classList.remove("opm-hidden");
		}
	});
}

function exportToPdfMonitoringInfo()
{
	
	var pdf = new jsPDF('p','pt','a4');
	pdf.addHTML(document.body,function() {
		pdf.save('web.pdf');
	});
	
}
	
	