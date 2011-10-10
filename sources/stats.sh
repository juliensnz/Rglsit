#!/bin/sh
# created by chris helming.
# chris dot helming at gmail

# get the current number of bytes in and bytes out
myvar1=`netstat -ib | grep -e "en0" -m 1 | awk '{print $7}'` #  bytes in
myvar3=`netstat -ib | grep -e "en0" -m 1 | awk '{print $10}'` # bytes out

#wait one second
sleep 1

# get the number of bytes in and out one second later
myvar2=`netstat -ib | grep -e "en0" -m 1 | awk '{print $7}'` # bytes in again
myvar4=`netstat -ib | grep -e "en0" -m 1 | awk '{print $10}'` # bytes out again

# find the difference between bytes in and out during that one second
subin=$(($myvar2 - $myvar1))
subout=$(($myvar4 - $myvar3))

# convert bytes to kilobytes
kbin=`echo "scale=2; $subin/1024;" | bc`
kbout=`echo "scale=2; $subout/1024;" | bc`

#cpuusage=`top -l 1 | fgrep "CPU usage" | awk '{print "cpu usage: ", $8}'`

cpuusage=`top -l 1| awk '/Load Avg/ {print "tab[\"cpuusage\"] = \"" $3 "\".substring(0,4);"}'`


cpurangeusage=`top -l 1| awk '/CPU usage/ {print "tab[\"cpuuser\"] = \"" $8 "\";" , "tab[\"cpusys\"] = \"" $10 "\";", "tab[\"cpuidle\"] = \"" $12 "\";"}'`

memrangeusage=`top -l 1| awk '/PhysMem/ {print "tab[\"memwired\"] = \"" $2 "\";" , "tab[\"memactive\"] = \"" $4 "\";", "tab[\"meminactive\"] = \"" $6 "\";", "tab[\"memused\"] = \"" $8 "\";", "tab[\"memfree\"] = \"" $10 "\";"}'`

# print the results
echo "tab[\"download\"] = $kbin;"
echo "tab[\"upload\"] = $kbout;"

echo $cpuusage
echo $cpurangeusage
echo $memrangeusage