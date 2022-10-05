using Microsoft.AspNetCore.Mvc;
using Server.Model;
using System.Data;
using System.Data.SqlClient;

namespace Server.Controllers
{
    [Route("api/")]
    [ApiController]
    public class UserController : ControllerBase
    {

        [HttpGet("getArticlesFromJournal")]
        public List<Article> getUrls(string journal,string username)
        {

            string sqlDataSource = "Data Source=.;Initial Catalog=2020ex1;Integrated Security = true;";

            string query = @"SELECT a.username,j.name,a.summary,a.date_ FROM article a"
                              +" INNER JOIN journal j ON a.jid=j.id WHERE j.name='" +journal + "' and a.username='"+username+"'";
            List<Article> articles = new List<Article>();

            try
            {
                SqlConnection connection = new SqlConnection(sqlDataSource);
                connection.Open();
                SqlCommand cmd = new SqlCommand(query, connection);
                SqlDataReader myReader;
                myReader = cmd.ExecuteReader();
                while (myReader.Read())
                {
                    Article art = new()
                    {
                        username = myReader.GetString("username"),
                        journalName = myReader.GetString("name"),
                        summary= myReader.GetString("summary"),
                        date = myReader.GetDateTime("date_").ToString().Split(" ")[0],  
                        
                    };
                    articles.Add(art);


                }

                myReader.Close();
                connection.Close();


            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.Message);
            }
            return articles;
        }

        [HttpPost("add")]
        public IActionResult add(Article art)
        {
            
            string sqlDataSource = "Data Source=.;Initial Catalog=2020ex1;Integrated Security = true;";
            SqlConnection connection = new SqlConnection(sqlDataSource);
            connection.Open();
            string query = "select id from journal where name='" + art.journalName + "'";
            SqlCommand cmd = new SqlCommand(query, connection);
            SqlDataReader myReader;
            myReader = cmd.ExecuteReader();
            myReader.Read();
            int jid;
            try
            {
                jid = myReader.GetInt32(0);
                myReader.Close();
            }
            catch(Exception)
            {
                myReader.Close();
                SqlCommand command = new SqlCommand(null, connection);

                // Create and prepare an SQL statement.
                command.CommandText = "INSERT INTO journal VALUES (@name)";
                SqlParameter nameParam = new SqlParameter("@name", SqlDbType.VarChar, 255);
                nameParam.Value = art.journalName;
                command.Parameters.Add(nameParam);
                Console.WriteLine(command.CommandText);
                // Call Prepare after setting the Commandtext and Parameters.
                command.Prepare();
                command.ExecuteNonQuery();
                string query2 = "select id from journal where name='" + art.journalName + "'";
                SqlCommand cmd2 = new SqlCommand(query, connection);
                SqlDataReader myReader2;
                myReader2 = cmd.ExecuteReader();
                myReader2.Read();
                jid = myReader2.GetInt32(0);
                myReader2.Close();
            }
            
            try
            {
                SqlCommand command = new SqlCommand(null, connection);

                // Create and prepare an SQL statement.
                command.CommandText = "INSERT INTO article VALUES (@username,@jid,@sum,@date)";
                SqlParameter usernameParam = new SqlParameter("@username", SqlDbType.VarChar,255);
                SqlParameter jidParam =
                    new SqlParameter("@jid", SqlDbType.Int);
                SqlParameter sumParam =
                    new SqlParameter("@sum", SqlDbType.VarChar,255);
                SqlParameter dateParam =
                    new SqlParameter("@date", SqlDbType.Date);
                usernameParam.Value = art.username;
                jidParam.Value = jid;
                sumParam.Value = art.summary;
                dateParam.Value= DateTime.Today;
                command.Parameters.Add(usernameParam);
                command.Parameters.Add(jidParam);
                command.Parameters.Add(sumParam);
                command.Parameters.Add(dateParam);
                Console.WriteLine(command.CommandText);
                // Call Prepare after setting the Commandtext and Parameters.
                command.Prepare();
                command.ExecuteNonQuery();



            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.Message);
            }
            return new JsonResult(art);
        }

    }
}