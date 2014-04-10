mysql = require 'mysql', exec = require 'child_process'
exec = exec.exec

kick = (name, msg) ->
	cmd = "echo \"User-Name='#{name}'\" | radclient -x -r 1 192.168.1.1 disconnect testing123"
	console.log msg, cmd
	exec cmd, (err, stdout, stderr) ->
		console.log(stderr, stdout)

test = (name)->
	connection = mysql.createConnection { host: 'localhost', user: 'radius', password: 'radius', database: 'radius' }
	connection.connect()
	q1 = "SELECT SUM(acctsessiontime) FROM radacct WHERE UserName='#{name}' "
	#console.log "q1", q1
	q2 = "SELECT SUM(AcctInputOctets) + SUM(AcctOutputOctets) FROM radacct WHERE UserName='#{name}'"
	#console.log q1, q2
	connection.query q1, (err, row, fields) ->
		if err
			console.log err
		else
			val = row[0]['SUM(acctsessiontime)']
			kick name, 'time exceed' if val > 60
	connection.query q2, (err, row, fields) ->
		if err
			console.log err
		else
			val = row[0]['SUM(AcctInputOctets) + SUM(AcctOutputOctets)']
			kick name, 'traffic exceed' if val > 1024*1024
	connection.end()


check = ->
	connection = mysql.createConnection { host: 'localhost', user: 'radius', password: 'radius', database: 'radius' }
	connection.connect()
	connection.query "SELECT * FROM `radacct`", (err, row, fields) ->
		if err 
			console.log err
		else
			for r in row
				user = r.username
				test(user)
	connection.end()

setInterval (()->check()), 1000
