import paramiko
import time

# Membaca daftar host dari file ip.txt
def read_ip(file_path):
    with open(file_path, 'r') as file:
        lines = file.readlines()
        hosts = [line.strip() for line in lines]
        return hosts

file_path = 'ip.txt'
hosts = read_ip(file_path)

command_list = [
    "\n",
    "/configure service vpls 265 name Coba customer 1 create",
    "\n",
    "/configure service vpls 265 service-mtu 9194"
]

def connect_to_host(ip):
    client = paramiko.SSHClient()
    client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    
    try:
        client.connect(ip, 22, "ns.yanwarangga", "banyak2dzikir")
        shell = client.invoke_shell()
        
        for command in command_list:
            shell.send(f"{command}\n")
            time.sleep(2)
            output = shell.recv(1000000).decode()
            print(output)
            
    except Exception as e:
        print(f"Gagal terhubung ke {ip}: {e}")
        
    finally:
        client.close()

def main():
    for ip in hosts:
        connect_to_host(ip)

if _name_ == "_main_":
    main()