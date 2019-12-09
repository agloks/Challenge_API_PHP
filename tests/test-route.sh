#!/bin/bash

ROUTES=( '/api/V1/product/create/' '/api/V1/categories/create/' '/api/V1/product/update/' '/api/V1/categories/update/' '/api/V1/product/remove/' '/api/V1/categories/remove/' '/api/V1/product/delete/' '/api/V1/categories/delete/' )


basic() 
{
	echo "going to test GET, press ENTER to continue..."
	read test
	for routes in "${ROUTES[@]}"
		do
			echo ""
			echo "GET routes test --> $routes ------->"
			curl -i --trace-time --retry-max-time 5 --max-time 20 --connect-timeout 20 --expect100-timeout 20 http://www.localhost:8000${routes}
			echo ""
		done

	echo "going to test POST, press ENTER to continue..."
	read test
	for routes in "${ROUTES[@]}"
		do
			echo ""
			echo "POST routes test --> $routes ------->"
			curl -i --trace-time --retry-max-time 5 --max-time 20 --connect-timeout 20 --expect100-timeout 20 -X POST http://www.localhost:8000${routes}
			echo ""
		done

	echo "going to test PUT, press ENTER to continue..."
	read test
	for routes in "${ROUTES[@]}"
		do
			echo ""
			echo "PUT route test --> $routes ------->"
			curl -i --trace-time --retry-max-time 5 --max-time 20 --connect-timeout 20 --expect100-timeout 20 -X PUT http://www.localhost:8000${routes}
			echo ""
		done

	echo "going to test PATCH, press ENTER to continue..."
	read test
	for routes in "${ROUTES[@]}"
		do
			echo ""
			echo "PATCH routes test --> $routes ------->"
			curl -i --trace-time --retry-max-time 5 --max-time 20 --connect-timeout 20 --expect100-timeout 20 -X PATCH http://www.localhost:8000${routes}
			echo ""
		done

	echo "going to test DELETE, press ENTER to continue..."
	read test
	for routes in "${ROUTES[@]}"
		do
			echo ""
			echo "DELETE routes test --> $routes ------->"
			curl -i --trace-time --retry-max-time 5 --max-time 20 --connect-timeout 20 --expect100-timeout 20 -X DELETE http://www.localhost:8000${routes}
			echo ""
		done
}


advanced() 
{
	echo "going to test GET, press ENTER to continue..."
	read test
	for routes in "${ROUTES[@]}"
		do
			echo ""
			echo "GET routes test --> $routes ------->"
			curl -i --trace-time --retry-max-time 5 --max-time 20 --connect-timeout 20 --expect100-timeout 20 http://www.localhost:8000${routes}
			echo ""
		done

	echo "going to test POST, press ENTER to continue..."
	read test
	for routes in "${ROUTES[@]}"
		do
			echo ""
			echo "POST routes test --> $routes ------->"
			curl -i --trace-time --retry-max-time 5 --max-time 20 --connect-timeout 20 --expect100-timeout 20 -X POST http://www.localhost:8000${routes} -d $payload
			echo ""
		done

	echo "going to test PUT, press ENTER to continue..."
	read test
	for routes in "${ROUTES[@]}"
		do
			echo ""
			echo "PUT route test --> $routes ------->"
			curl -i --trace-time --retry-max-time 5 --max-time 20 --connect-timeout 20 --expect100-timeout 20 -X PUT http://www.localhost:8000${routes} -d $payload
			echo ""
		done

	echo "going to test PATCH, press ENTER to continue..."
	read test
	for routes in "${ROUTES[@]}"
		do
			echo ""
			echo "PATCH routes test --> $routes ------->"
			curl -i --trace-time --retry-max-time 5 --max-time 20 --connect-timeout 20 --expect100-timeout 20 -X PATCH http://www.localhost:8000${routes} -d $payload
			echo ""
		done

	echo "going to test DELETE, press ENTER to continue..."
	read test
	for routes in "${ROUTES[@]}"
		do
			echo ""
			echo "DELETE routes test --> $routes ------->"
			curl -i --trace-time --retry-max-time 5 --max-time 20 --connect-timeout 20 --expect100-timeout 20 -X DELETE http://www.localhost:8000${routes} -d $payload
			echo ""
		done
}

if [ -f $1 ]; then
	payload=$(cat $1)
	advanced
else
	echo "without payload"
	basic
fi